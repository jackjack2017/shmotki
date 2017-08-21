<?php


namespace Webmagic\Dashboard\Generators;


class ComponentGenerator
{
    /**
     * return prepared input type=text
     *
     * @param string $name
     * @param null $value
     * @param string $label
     * @param array $options
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     * @throws \Throwable
     */
    public function text($name, $value = null, $label = '', $options = [])
    {
        $options['class'] = isset($options['class']) ? $options['class'] . ' form-control ' : ' form-control ';

        return view('dashboard::components._text', compact('name', 'value', 'options', 'label'))->render();
    }

    /**
     * @param $name
     * @param array $available_values
     * @param null $value
     * @param string $label
     * @param array $options
     * @return string
     */
    public function select($name, $available_values = [], $value = null, $label = '', $options = [])
    {
        $options['class'] = isset($options['class']) ? $options['class'] . ' form-control ' : ' form-control ';

        return view('dashboard::components._select', compact('name', 'available_values', 'value', 'options', 'label'))->render();
    }


    /**
     * Create simple textarea
     *
     * @param $name
     * @param null $value
     * @param string $label
     * @param array $options
     * @return string
     * @throws \Exception
     * @throws \Throwable
     */
    public function textarea($name, $value = null, $label = '', $options = [])
    {
        $options['class'] = isset($options['class']) ? $options['class'] . ' form-control' : ' form-control ';

        return view('dashboard::components._textarea', compact('name', 'value', 'options', 'label'))->render();
    }

    /**
     * Create textarea with JS editor
     *
     * @param $name
     * @param null $value
     * @param string $label
     * @param array $options
     * @return string
     */
    public function textareaWYSIHTML5($name, $value = null, $label = '', $options = [])
    {
        $options['class'] = isset($options['class']) ? $options['class'] . ' js-editor ' : ' js-editor ';

        return $this->textarea($name, $value, $label, $options);
    }

    /**
     * Create file load block
     *
     * @param $name
     * @param string $label
     * @param array $options
     * @return string
     * @throws \Exception
     * @throws \Throwable
     */
    public function file($name, $label = '', $options = [])
    {
        return view('dashboard::components._file', compact('name', 'label', 'options'))->render();
    }

    /**
     * @param        $name
     * @param string $label
     * @param string $current_img
     * @param array  $options
     * @param bool   $show_images_file_name
     *
     * @return string
     * @throws \Exception
     * @throws \Throwable
     */
    public function imageLoad($name, $label = '', $current_img = '', $options = [], $show_details = false)
    {
        $current_img = $current_img === '' ? url('webmagic/dashboard/img/img-placeholder.png') : $current_img;
        $options['class'] = isset($options['class']) ? $options['class'] . ' js_image-preview hidden' : ' js_image-preview hidden';
        $options['accept'] = isset($options['accept']) ? $options['accept'] . 'image/*' : 'image/*';
        $options['data-preview'] = '.js_media-preview-' . $name;

//        if($show_details){
//            if(gettype($current_img) === 'array'){
//                foreach($current_img as $key => $image){
//                    $image_details[$key] = file_exists($image) ? getimagesize($image) : ['',''];
//                }
//            } else {
//                dump($current_img);
//                dd(file_exists($current_img));
//                $image_details = file_exists($current_img) ? getimagesize($current_img) : ['',''];
//            }
//
//        } else {
//            $image_details = '';
//        }

        return view('dashboard::components._image_load', compact('name', 'label', 'options', 'current_img', 'show_details', 'image_details'))->render();
    }

    /**
     * @param $name
     * @param $label
     * @param array $options
     * @return string
     * @throws \Exception
     * @throws \Throwable
     */
    public function checkbox($name, $label, $value = null, $status = false, array $options = [])
    {
        $options['id'] = isset($options['id']) ? $options['id'] . ' ' . $name : $name;

        return view('dashboard::components._checkbox', compact('name', 'label', 'value', 'status', 'options'))->render();
    }


    /**
     * Create table
     *
     * @param array $titles
     * @param array $options
     * @param array $items
     * @return string
     *
     * @example $options = [
     *              'paging' => 10                          //false for off
     *              'searching' => true
     *
     *           'titles' => [
     *              'data_key' => [] OR string
     *                  @if Array
     *                  'title' => 'Data title',
     *                  'link_key' => 'link.key',              //default unset
     *               ],
     *            ],
     *
     */
    public function dataTable(array $titles, array $options, $items)
    {
        $def_options = [
            "paging" => 10,
            "searching" => true,
        ];

        $options = array_merge($def_options, $options);

        if(!count($items)){
            return '';
        }

        //Prepare items values
        foreach($titles as $key => $title){
            if(!strpos('.', $key)){
                foreach($items as &$item){
                    if(gettype($title) == 'array'){
                        $tmp['value'] = $this->getValueFromArrayOrObject($key, $item);
                        if(isset($title['link_key'])){
                            $tmp['link'] = $this->getValueFromArrayOrObject($title['link_key'], $item);
                        }
                        $item[$key] = $tmp;

                    } else {
                        $item[$key] = $this->getValueFromArrayOrObject($key, $item);
                    }
                }
            }
        }

        return view('dashboard::components._data_table', compact('titles', 'options', 'items'))->render();
    }


    protected function getValueFromArrayOrObject($keys_string, $item)
    {
        $keys = explode('.', $keys_string);
        $value = $item->{$keys[0]};
        for($i = 1; $i < count($keys); $i++){
            $value = gettype($value == 'object') ? $value->{$keys[$i]} : $value[$keys[$i]];
        }

        return $value;
    }

}