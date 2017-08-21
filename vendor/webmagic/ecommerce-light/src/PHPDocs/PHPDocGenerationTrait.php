<?php


namespace Webmagic\EcommerceLight\PHPDocs;


use Exception;
use ReflectionClass;
use ReflectionMethod;
use ReflectionParameter;
use ReflectionType;

trait PHPDocGenerationTrait
{
    /** @var string template for generating php doc */
    protected $stub = __DIR__ . '/comment_block.stub';

    /** @var string key for placing php docs */
    protected $php_doc_key = PHP_EOL . 'class';

    /**
     * Generate php docs
     * based on defined in attribute classes
     */
    public function generatePHPDocs()
    {
        $doc_block = $this->generateDocBlock();

        $this->updateDocBlock($doc_block);
    }

    /**
     * Update php docs in current class file
     *
     * @param $doc_block
     */
    protected function updateDocBlock($doc_block)
    {
        $ref_class = new ReflectionClass($this);
        $file_path = $ref_class->getFileName();

        $file = file_get_contents($file_path);

        $key = $this->php_doc_key;
        $file = str_replace($key, $doc_block . $key, $file);

        file_put_contents($file_path, $file);
    }

    /**
     * Generate doc block
     *
     * @return string
     */
    protected function generateDocBlock()
    {
        $classes = $this->getEntities();

        $doc_block = '';
        foreach ($classes as $alias => $class) {
            $doc_block .= $this->generateForClass($class, $alias) . PHP_EOL . PHP_EOL;
        }
        
        $doc_block = substr_replace($doc_block, '/', 0, 1);
//        dd(strripos($doc_block, '**'));
        $doc_block = substr_replace($doc_block, '*/', strripos($doc_block, '**'), 2);

//        dd($doc_block);

        return PHP_EOL . PHP_EOL . "$doc_block";
    }

    /**
     * Load needs entities
     *
     * @return mixed
     */
    protected function getEntities()
    {
        try {
            return $this->classes;
        } catch (Exception $e) {
            return new Exception('Parameter $classes not defined');
        }
    }

    /**
     * Generate comment for class
     *
     * @param        $class
     *
     * @param string $methods_alias
     *
     * @return mixed|string
     */
    protected function generateForClass($class, $methods_alias = '')
    {
        $ref_class = new ReflectionClass($class);
        $methods = $ref_class->getMethods();

        $methods_string = '';
        $last_method_key = count($methods) - 1;
        foreach ($methods as $key => $method) {
            $methods_string .= $this->generateForMethod($method, $methods_alias);
            $methods_string .= $last_method_key > $key ? PHP_EOL : '';
        }

        $block = file_get_contents($this->stub);
        $block = str_replace('class_name', $ref_class->name, $block);
        $block = str_replace('methods', $methods_string, $block);

        return $block;
    }

    /**
     * Generate string for method
     *
     * @param ReflectionMethod $method
     *
     * @return string
     */
    protected function generateForMethod(ReflectionMethod $method, $alias)
    {
        $name = $alias . ucfirst($method->name);
        $return = $method->getReturnType();
        switch ($return) {
            case '':
                $return = 'void';
                break;
            case !$return->isBuiltin():
                $try_class = '\\' . $return;
                $return = class_exists($try_class) ? $try_class : $return;
                break;
        }

        $params = $method->getParameters();

        $params_string = '';
        $param_count = $method->getNumberOfParameters();
        $last_param_key = $param_count - 1;
        if ($param_count) {
            foreach ($params as $key => $param) {
                $params_string .= $this->generateForParam($param);
                $params_string .= $last_param_key > $key ? ", " : '';
            }
        }

        return " * @method $return $name($params_string)";
    }

    /**
     * Generate string for param
     *
     * @param ReflectionParameter $param
     *
     * @return string
     */
    protected function generateForParam(ReflectionParameter $param): string
    {
        $name = $param->name;
        $type = $param->getType();
        $type = $this->normalizeType($type);

        return $type ? "$type $$name" : $name;
    }

    /**
     * Normalize type
     *
     * @param ReflectionType|null $type
     *
     * @return string
     */
    protected function normalizeType(ReflectionType $type = null): string
    {
        switch ($type) {
            case null:
                $type = 'string';
                break;
            case !$type->isBuiltin():
                $try_class = '\\' . $type;
                $type = class_exists($try_class) ? $try_class : $type;
                break;
        }

        return $type;
    }
}