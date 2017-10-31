/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;
/******/
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			exports: {},
/******/ 			id: moduleId,
/******/ 			loaded: false
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.loaded = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/js/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports, __webpack_require__) {

	'use strict';
	
	__webpack_require__(78);

/***/ },
/* 1 */,
/* 2 */,
/* 3 */
/***/ function(module, exports, __webpack_require__) {

	"use strict";
	
	exports.__esModule = true;
	
	var _iterator = __webpack_require__(4);
	
	var _iterator2 = _interopRequireDefault(_iterator);
	
	var _symbol = __webpack_require__(55);
	
	var _symbol2 = _interopRequireDefault(_symbol);
	
	var _typeof = typeof _symbol2.default === "function" && typeof _iterator2.default === "symbol" ? function (obj) { return typeof obj; } : function (obj) { return obj && typeof _symbol2.default === "function" && obj.constructor === _symbol2.default ? "symbol" : typeof obj; };
	
	function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }
	
	exports.default = typeof _symbol2.default === "function" && _typeof(_iterator2.default) === "symbol" ? function (obj) {
	  return typeof obj === "undefined" ? "undefined" : _typeof(obj);
	} : function (obj) {
	  return obj && typeof _symbol2.default === "function" && obj.constructor === _symbol2.default ? "symbol" : typeof obj === "undefined" ? "undefined" : _typeof(obj);
	};

/***/ },
/* 4 */
/***/ function(module, exports, __webpack_require__) {

	module.exports = { "default": __webpack_require__(5), __esModule: true };

/***/ },
/* 5 */
/***/ function(module, exports, __webpack_require__) {

	__webpack_require__(6);
	__webpack_require__(50);
	module.exports = __webpack_require__(54).f('iterator');

/***/ },
/* 6 */
/***/ function(module, exports, __webpack_require__) {

	'use strict';
	var $at  = __webpack_require__(7)(true);
	
	// 21.1.3.27 String.prototype[@@iterator]()
	__webpack_require__(10)(String, 'String', function(iterated){
	  this._t = String(iterated); // target
	  this._i = 0;                // next index
	// 21.1.5.2.1 %StringIteratorPrototype%.next()
	}, function(){
	  var O     = this._t
	    , index = this._i
	    , point;
	  if(index >= O.length)return {value: undefined, done: true};
	  point = $at(O, index);
	  this._i += point.length;
	  return {value: point, done: false};
	});

/***/ },
/* 7 */
/***/ function(module, exports, __webpack_require__) {

	var toInteger = __webpack_require__(8)
	  , defined   = __webpack_require__(9);
	// true  -> String#at
	// false -> String#codePointAt
	module.exports = function(TO_STRING){
	  return function(that, pos){
	    var s = String(defined(that))
	      , i = toInteger(pos)
	      , l = s.length
	      , a, b;
	    if(i < 0 || i >= l)return TO_STRING ? '' : undefined;
	    a = s.charCodeAt(i);
	    return a < 0xd800 || a > 0xdbff || i + 1 === l || (b = s.charCodeAt(i + 1)) < 0xdc00 || b > 0xdfff
	      ? TO_STRING ? s.charAt(i) : a
	      : TO_STRING ? s.slice(i, i + 2) : (a - 0xd800 << 10) + (b - 0xdc00) + 0x10000;
	  };
	};

/***/ },
/* 8 */
/***/ function(module, exports) {

	// 7.1.4 ToInteger
	var ceil  = Math.ceil
	  , floor = Math.floor;
	module.exports = function(it){
	  return isNaN(it = +it) ? 0 : (it > 0 ? floor : ceil)(it);
	};

/***/ },
/* 9 */
/***/ function(module, exports) {

	// 7.2.1 RequireObjectCoercible(argument)
	module.exports = function(it){
	  if(it == undefined)throw TypeError("Can't call method on  " + it);
	  return it;
	};

/***/ },
/* 10 */
/***/ function(module, exports, __webpack_require__) {

	'use strict';
	var LIBRARY        = __webpack_require__(11)
	  , $export        = __webpack_require__(12)
	  , redefine       = __webpack_require__(27)
	  , hide           = __webpack_require__(17)
	  , has            = __webpack_require__(28)
	  , Iterators      = __webpack_require__(29)
	  , $iterCreate    = __webpack_require__(30)
	  , setToStringTag = __webpack_require__(46)
	  , getPrototypeOf = __webpack_require__(48)
	  , ITERATOR       = __webpack_require__(47)('iterator')
	  , BUGGY          = !([].keys && 'next' in [].keys()) // Safari has buggy iterators w/o `next`
	  , FF_ITERATOR    = '@@iterator'
	  , KEYS           = 'keys'
	  , VALUES         = 'values';
	
	var returnThis = function(){ return this; };
	
	module.exports = function(Base, NAME, Constructor, next, DEFAULT, IS_SET, FORCED){
	  $iterCreate(Constructor, NAME, next);
	  var getMethod = function(kind){
	    if(!BUGGY && kind in proto)return proto[kind];
	    switch(kind){
	      case KEYS: return function keys(){ return new Constructor(this, kind); };
	      case VALUES: return function values(){ return new Constructor(this, kind); };
	    } return function entries(){ return new Constructor(this, kind); };
	  };
	  var TAG        = NAME + ' Iterator'
	    , DEF_VALUES = DEFAULT == VALUES
	    , VALUES_BUG = false
	    , proto      = Base.prototype
	    , $native    = proto[ITERATOR] || proto[FF_ITERATOR] || DEFAULT && proto[DEFAULT]
	    , $default   = $native || getMethod(DEFAULT)
	    , $entries   = DEFAULT ? !DEF_VALUES ? $default : getMethod('entries') : undefined
	    , $anyNative = NAME == 'Array' ? proto.entries || $native : $native
	    , methods, key, IteratorPrototype;
	  // Fix native
	  if($anyNative){
	    IteratorPrototype = getPrototypeOf($anyNative.call(new Base));
	    if(IteratorPrototype !== Object.prototype){
	      // Set @@toStringTag to native iterators
	      setToStringTag(IteratorPrototype, TAG, true);
	      // fix for some old engines
	      if(!LIBRARY && !has(IteratorPrototype, ITERATOR))hide(IteratorPrototype, ITERATOR, returnThis);
	    }
	  }
	  // fix Array#{values, @@iterator}.name in V8 / FF
	  if(DEF_VALUES && $native && $native.name !== VALUES){
	    VALUES_BUG = true;
	    $default = function values(){ return $native.call(this); };
	  }
	  // Define iterator
	  if((!LIBRARY || FORCED) && (BUGGY || VALUES_BUG || !proto[ITERATOR])){
	    hide(proto, ITERATOR, $default);
	  }
	  // Plug for library
	  Iterators[NAME] = $default;
	  Iterators[TAG]  = returnThis;
	  if(DEFAULT){
	    methods = {
	      values:  DEF_VALUES ? $default : getMethod(VALUES),
	      keys:    IS_SET     ? $default : getMethod(KEYS),
	      entries: $entries
	    };
	    if(FORCED)for(key in methods){
	      if(!(key in proto))redefine(proto, key, methods[key]);
	    } else $export($export.P + $export.F * (BUGGY || VALUES_BUG), NAME, methods);
	  }
	  return methods;
	};

/***/ },
/* 11 */
/***/ function(module, exports) {

	module.exports = true;

/***/ },
/* 12 */
/***/ function(module, exports, __webpack_require__) {

	var global    = __webpack_require__(13)
	  , core      = __webpack_require__(14)
	  , ctx       = __webpack_require__(15)
	  , hide      = __webpack_require__(17)
	  , PROTOTYPE = 'prototype';
	
	var $export = function(type, name, source){
	  var IS_FORCED = type & $export.F
	    , IS_GLOBAL = type & $export.G
	    , IS_STATIC = type & $export.S
	    , IS_PROTO  = type & $export.P
	    , IS_BIND   = type & $export.B
	    , IS_WRAP   = type & $export.W
	    , exports   = IS_GLOBAL ? core : core[name] || (core[name] = {})
	    , expProto  = exports[PROTOTYPE]
	    , target    = IS_GLOBAL ? global : IS_STATIC ? global[name] : (global[name] || {})[PROTOTYPE]
	    , key, own, out;
	  if(IS_GLOBAL)source = name;
	  for(key in source){
	    // contains in native
	    own = !IS_FORCED && target && target[key] !== undefined;
	    if(own && key in exports)continue;
	    // export native or passed
	    out = own ? target[key] : source[key];
	    // prevent global pollution for namespaces
	    exports[key] = IS_GLOBAL && typeof target[key] != 'function' ? source[key]
	    // bind timers to global for call from export context
	    : IS_BIND && own ? ctx(out, global)
	    // wrap global constructors for prevent change them in library
	    : IS_WRAP && target[key] == out ? (function(C){
	      var F = function(a, b, c){
	        if(this instanceof C){
	          switch(arguments.length){
	            case 0: return new C;
	            case 1: return new C(a);
	            case 2: return new C(a, b);
	          } return new C(a, b, c);
	        } return C.apply(this, arguments);
	      };
	      F[PROTOTYPE] = C[PROTOTYPE];
	      return F;
	    // make static versions for prototype methods
	    })(out) : IS_PROTO && typeof out == 'function' ? ctx(Function.call, out) : out;
	    // export proto methods to core.%CONSTRUCTOR%.methods.%NAME%
	    if(IS_PROTO){
	      (exports.virtual || (exports.virtual = {}))[key] = out;
	      // export proto methods to core.%CONSTRUCTOR%.prototype.%NAME%
	      if(type & $export.R && expProto && !expProto[key])hide(expProto, key, out);
	    }
	  }
	};
	// type bitmap
	$export.F = 1;   // forced
	$export.G = 2;   // global
	$export.S = 4;   // static
	$export.P = 8;   // proto
	$export.B = 16;  // bind
	$export.W = 32;  // wrap
	$export.U = 64;  // safe
	$export.R = 128; // real proto method for `library` 
	module.exports = $export;

/***/ },
/* 13 */
/***/ function(module, exports) {

	// https://github.com/zloirock/core-js/issues/86#issuecomment-115759028
	var global = module.exports = typeof window != 'undefined' && window.Math == Math
	  ? window : typeof self != 'undefined' && self.Math == Math ? self : Function('return this')();
	if(typeof __g == 'number')__g = global; // eslint-disable-line no-undef

/***/ },
/* 14 */
/***/ function(module, exports) {

	var core = module.exports = {version: '2.4.0'};
	if(typeof __e == 'number')__e = core; // eslint-disable-line no-undef

/***/ },
/* 15 */
/***/ function(module, exports, __webpack_require__) {

	// optional / simple context binding
	var aFunction = __webpack_require__(16);
	module.exports = function(fn, that, length){
	  aFunction(fn);
	  if(that === undefined)return fn;
	  switch(length){
	    case 1: return function(a){
	      return fn.call(that, a);
	    };
	    case 2: return function(a, b){
	      return fn.call(that, a, b);
	    };
	    case 3: return function(a, b, c){
	      return fn.call(that, a, b, c);
	    };
	  }
	  return function(/* ...args */){
	    return fn.apply(that, arguments);
	  };
	};

/***/ },
/* 16 */
/***/ function(module, exports) {

	module.exports = function(it){
	  if(typeof it != 'function')throw TypeError(it + ' is not a function!');
	  return it;
	};

/***/ },
/* 17 */
/***/ function(module, exports, __webpack_require__) {

	var dP         = __webpack_require__(18)
	  , createDesc = __webpack_require__(26);
	module.exports = __webpack_require__(22) ? function(object, key, value){
	  return dP.f(object, key, createDesc(1, value));
	} : function(object, key, value){
	  object[key] = value;
	  return object;
	};

/***/ },
/* 18 */
/***/ function(module, exports, __webpack_require__) {

	var anObject       = __webpack_require__(19)
	  , IE8_DOM_DEFINE = __webpack_require__(21)
	  , toPrimitive    = __webpack_require__(25)
	  , dP             = Object.defineProperty;
	
	exports.f = __webpack_require__(22) ? Object.defineProperty : function defineProperty(O, P, Attributes){
	  anObject(O);
	  P = toPrimitive(P, true);
	  anObject(Attributes);
	  if(IE8_DOM_DEFINE)try {
	    return dP(O, P, Attributes);
	  } catch(e){ /* empty */ }
	  if('get' in Attributes || 'set' in Attributes)throw TypeError('Accessors not supported!');
	  if('value' in Attributes)O[P] = Attributes.value;
	  return O;
	};

/***/ },
/* 19 */
/***/ function(module, exports, __webpack_require__) {

	var isObject = __webpack_require__(20);
	module.exports = function(it){
	  if(!isObject(it))throw TypeError(it + ' is not an object!');
	  return it;
	};

/***/ },
/* 20 */
/***/ function(module, exports) {

	module.exports = function(it){
	  return typeof it === 'object' ? it !== null : typeof it === 'function';
	};

/***/ },
/* 21 */
/***/ function(module, exports, __webpack_require__) {

	module.exports = !__webpack_require__(22) && !__webpack_require__(23)(function(){
	  return Object.defineProperty(__webpack_require__(24)('div'), 'a', {get: function(){ return 7; }}).a != 7;
	});

/***/ },
/* 22 */
/***/ function(module, exports, __webpack_require__) {

	// Thank's IE8 for his funny defineProperty
	module.exports = !__webpack_require__(23)(function(){
	  return Object.defineProperty({}, 'a', {get: function(){ return 7; }}).a != 7;
	});

/***/ },
/* 23 */
/***/ function(module, exports) {

	module.exports = function(exec){
	  try {
	    return !!exec();
	  } catch(e){
	    return true;
	  }
	};

/***/ },
/* 24 */
/***/ function(module, exports, __webpack_require__) {

	var isObject = __webpack_require__(20)
	  , document = __webpack_require__(13).document
	  // in old IE typeof document.createElement is 'object'
	  , is = isObject(document) && isObject(document.createElement);
	module.exports = function(it){
	  return is ? document.createElement(it) : {};
	};

/***/ },
/* 25 */
/***/ function(module, exports, __webpack_require__) {

	// 7.1.1 ToPrimitive(input [, PreferredType])
	var isObject = __webpack_require__(20);
	// instead of the ES6 spec version, we didn't implement @@toPrimitive case
	// and the second argument - flag - preferred type is a string
	module.exports = function(it, S){
	  if(!isObject(it))return it;
	  var fn, val;
	  if(S && typeof (fn = it.toString) == 'function' && !isObject(val = fn.call(it)))return val;
	  if(typeof (fn = it.valueOf) == 'function' && !isObject(val = fn.call(it)))return val;
	  if(!S && typeof (fn = it.toString) == 'function' && !isObject(val = fn.call(it)))return val;
	  throw TypeError("Can't convert object to primitive value");
	};

/***/ },
/* 26 */
/***/ function(module, exports) {

	module.exports = function(bitmap, value){
	  return {
	    enumerable  : !(bitmap & 1),
	    configurable: !(bitmap & 2),
	    writable    : !(bitmap & 4),
	    value       : value
	  };
	};

/***/ },
/* 27 */
/***/ function(module, exports, __webpack_require__) {

	module.exports = __webpack_require__(17);

/***/ },
/* 28 */
/***/ function(module, exports) {

	var hasOwnProperty = {}.hasOwnProperty;
	module.exports = function(it, key){
	  return hasOwnProperty.call(it, key);
	};

/***/ },
/* 29 */
/***/ function(module, exports) {

	module.exports = {};

/***/ },
/* 30 */
/***/ function(module, exports, __webpack_require__) {

	'use strict';
	var create         = __webpack_require__(31)
	  , descriptor     = __webpack_require__(26)
	  , setToStringTag = __webpack_require__(46)
	  , IteratorPrototype = {};
	
	// 25.1.2.1.1 %IteratorPrototype%[@@iterator]()
	__webpack_require__(17)(IteratorPrototype, __webpack_require__(47)('iterator'), function(){ return this; });
	
	module.exports = function(Constructor, NAME, next){
	  Constructor.prototype = create(IteratorPrototype, {next: descriptor(1, next)});
	  setToStringTag(Constructor, NAME + ' Iterator');
	};

/***/ },
/* 31 */
/***/ function(module, exports, __webpack_require__) {

	// 19.1.2.2 / 15.2.3.5 Object.create(O [, Properties])
	var anObject    = __webpack_require__(19)
	  , dPs         = __webpack_require__(32)
	  , enumBugKeys = __webpack_require__(44)
	  , IE_PROTO    = __webpack_require__(41)('IE_PROTO')
	  , Empty       = function(){ /* empty */ }
	  , PROTOTYPE   = 'prototype';
	
	// Create object with fake `null` prototype: use iframe Object with cleared prototype
	var createDict = function(){
	  // Thrash, waste and sodomy: IE GC bug
	  var iframe = __webpack_require__(24)('iframe')
	    , i      = enumBugKeys.length
	    , lt     = '<'
	    , gt     = '>'
	    , iframeDocument;
	  iframe.style.display = 'none';
	  __webpack_require__(45).appendChild(iframe);
	  iframe.src = 'javascript:'; // eslint-disable-line no-script-url
	  // createDict = iframe.contentWindow.Object;
	  // html.removeChild(iframe);
	  iframeDocument = iframe.contentWindow.document;
	  iframeDocument.open();
	  iframeDocument.write(lt + 'script' + gt + 'document.F=Object' + lt + '/script' + gt);
	  iframeDocument.close();
	  createDict = iframeDocument.F;
	  while(i--)delete createDict[PROTOTYPE][enumBugKeys[i]];
	  return createDict();
	};
	
	module.exports = Object.create || function create(O, Properties){
	  var result;
	  if(O !== null){
	    Empty[PROTOTYPE] = anObject(O);
	    result = new Empty;
	    Empty[PROTOTYPE] = null;
	    // add "__proto__" for Object.getPrototypeOf polyfill
	    result[IE_PROTO] = O;
	  } else result = createDict();
	  return Properties === undefined ? result : dPs(result, Properties);
	};


/***/ },
/* 32 */
/***/ function(module, exports, __webpack_require__) {

	var dP       = __webpack_require__(18)
	  , anObject = __webpack_require__(19)
	  , getKeys  = __webpack_require__(33);
	
	module.exports = __webpack_require__(22) ? Object.defineProperties : function defineProperties(O, Properties){
	  anObject(O);
	  var keys   = getKeys(Properties)
	    , length = keys.length
	    , i = 0
	    , P;
	  while(length > i)dP.f(O, P = keys[i++], Properties[P]);
	  return O;
	};

/***/ },
/* 33 */
/***/ function(module, exports, __webpack_require__) {

	// 19.1.2.14 / 15.2.3.14 Object.keys(O)
	var $keys       = __webpack_require__(34)
	  , enumBugKeys = __webpack_require__(44);
	
	module.exports = Object.keys || function keys(O){
	  return $keys(O, enumBugKeys);
	};

/***/ },
/* 34 */
/***/ function(module, exports, __webpack_require__) {

	var has          = __webpack_require__(28)
	  , toIObject    = __webpack_require__(35)
	  , arrayIndexOf = __webpack_require__(38)(false)
	  , IE_PROTO     = __webpack_require__(41)('IE_PROTO');
	
	module.exports = function(object, names){
	  var O      = toIObject(object)
	    , i      = 0
	    , result = []
	    , key;
	  for(key in O)if(key != IE_PROTO)has(O, key) && result.push(key);
	  // Don't enum bug & hidden keys
	  while(names.length > i)if(has(O, key = names[i++])){
	    ~arrayIndexOf(result, key) || result.push(key);
	  }
	  return result;
	};

/***/ },
/* 35 */
/***/ function(module, exports, __webpack_require__) {

	// to indexed object, toObject with fallback for non-array-like ES3 strings
	var IObject = __webpack_require__(36)
	  , defined = __webpack_require__(9);
	module.exports = function(it){
	  return IObject(defined(it));
	};

/***/ },
/* 36 */
/***/ function(module, exports, __webpack_require__) {

	// fallback for non-array-like ES3 and non-enumerable old V8 strings
	var cof = __webpack_require__(37);
	module.exports = Object('z').propertyIsEnumerable(0) ? Object : function(it){
	  return cof(it) == 'String' ? it.split('') : Object(it);
	};

/***/ },
/* 37 */
/***/ function(module, exports) {

	var toString = {}.toString;
	
	module.exports = function(it){
	  return toString.call(it).slice(8, -1);
	};

/***/ },
/* 38 */
/***/ function(module, exports, __webpack_require__) {

	// false -> Array#indexOf
	// true  -> Array#includes
	var toIObject = __webpack_require__(35)
	  , toLength  = __webpack_require__(39)
	  , toIndex   = __webpack_require__(40);
	module.exports = function(IS_INCLUDES){
	  return function($this, el, fromIndex){
	    var O      = toIObject($this)
	      , length = toLength(O.length)
	      , index  = toIndex(fromIndex, length)
	      , value;
	    // Array#includes uses SameValueZero equality algorithm
	    if(IS_INCLUDES && el != el)while(length > index){
	      value = O[index++];
	      if(value != value)return true;
	    // Array#toIndex ignores holes, Array#includes - not
	    } else for(;length > index; index++)if(IS_INCLUDES || index in O){
	      if(O[index] === el)return IS_INCLUDES || index || 0;
	    } return !IS_INCLUDES && -1;
	  };
	};

/***/ },
/* 39 */
/***/ function(module, exports, __webpack_require__) {

	// 7.1.15 ToLength
	var toInteger = __webpack_require__(8)
	  , min       = Math.min;
	module.exports = function(it){
	  return it > 0 ? min(toInteger(it), 0x1fffffffffffff) : 0; // pow(2, 53) - 1 == 9007199254740991
	};

/***/ },
/* 40 */
/***/ function(module, exports, __webpack_require__) {

	var toInteger = __webpack_require__(8)
	  , max       = Math.max
	  , min       = Math.min;
	module.exports = function(index, length){
	  index = toInteger(index);
	  return index < 0 ? max(index + length, 0) : min(index, length);
	};

/***/ },
/* 41 */
/***/ function(module, exports, __webpack_require__) {

	var shared = __webpack_require__(42)('keys')
	  , uid    = __webpack_require__(43);
	module.exports = function(key){
	  return shared[key] || (shared[key] = uid(key));
	};

/***/ },
/* 42 */
/***/ function(module, exports, __webpack_require__) {

	var global = __webpack_require__(13)
	  , SHARED = '__core-js_shared__'
	  , store  = global[SHARED] || (global[SHARED] = {});
	module.exports = function(key){
	  return store[key] || (store[key] = {});
	};

/***/ },
/* 43 */
/***/ function(module, exports) {

	var id = 0
	  , px = Math.random();
	module.exports = function(key){
	  return 'Symbol('.concat(key === undefined ? '' : key, ')_', (++id + px).toString(36));
	};

/***/ },
/* 44 */
/***/ function(module, exports) {

	// IE 8- don't enum bug keys
	module.exports = (
	  'constructor,hasOwnProperty,isPrototypeOf,propertyIsEnumerable,toLocaleString,toString,valueOf'
	).split(',');

/***/ },
/* 45 */
/***/ function(module, exports, __webpack_require__) {

	module.exports = __webpack_require__(13).document && document.documentElement;

/***/ },
/* 46 */
/***/ function(module, exports, __webpack_require__) {

	var def = __webpack_require__(18).f
	  , has = __webpack_require__(28)
	  , TAG = __webpack_require__(47)('toStringTag');
	
	module.exports = function(it, tag, stat){
	  if(it && !has(it = stat ? it : it.prototype, TAG))def(it, TAG, {configurable: true, value: tag});
	};

/***/ },
/* 47 */
/***/ function(module, exports, __webpack_require__) {

	var store      = __webpack_require__(42)('wks')
	  , uid        = __webpack_require__(43)
	  , Symbol     = __webpack_require__(13).Symbol
	  , USE_SYMBOL = typeof Symbol == 'function';
	
	var $exports = module.exports = function(name){
	  return store[name] || (store[name] =
	    USE_SYMBOL && Symbol[name] || (USE_SYMBOL ? Symbol : uid)('Symbol.' + name));
	};
	
	$exports.store = store;

/***/ },
/* 48 */
/***/ function(module, exports, __webpack_require__) {

	// 19.1.2.9 / 15.2.3.2 Object.getPrototypeOf(O)
	var has         = __webpack_require__(28)
	  , toObject    = __webpack_require__(49)
	  , IE_PROTO    = __webpack_require__(41)('IE_PROTO')
	  , ObjectProto = Object.prototype;
	
	module.exports = Object.getPrototypeOf || function(O){
	  O = toObject(O);
	  if(has(O, IE_PROTO))return O[IE_PROTO];
	  if(typeof O.constructor == 'function' && O instanceof O.constructor){
	    return O.constructor.prototype;
	  } return O instanceof Object ? ObjectProto : null;
	};

/***/ },
/* 49 */
/***/ function(module, exports, __webpack_require__) {

	// 7.1.13 ToObject(argument)
	var defined = __webpack_require__(9);
	module.exports = function(it){
	  return Object(defined(it));
	};

/***/ },
/* 50 */
/***/ function(module, exports, __webpack_require__) {

	__webpack_require__(51);
	var global        = __webpack_require__(13)
	  , hide          = __webpack_require__(17)
	  , Iterators     = __webpack_require__(29)
	  , TO_STRING_TAG = __webpack_require__(47)('toStringTag');
	
	for(var collections = ['NodeList', 'DOMTokenList', 'MediaList', 'StyleSheetList', 'CSSRuleList'], i = 0; i < 5; i++){
	  var NAME       = collections[i]
	    , Collection = global[NAME]
	    , proto      = Collection && Collection.prototype;
	  if(proto && !proto[TO_STRING_TAG])hide(proto, TO_STRING_TAG, NAME);
	  Iterators[NAME] = Iterators.Array;
	}

/***/ },
/* 51 */
/***/ function(module, exports, __webpack_require__) {

	'use strict';
	var addToUnscopables = __webpack_require__(52)
	  , step             = __webpack_require__(53)
	  , Iterators        = __webpack_require__(29)
	  , toIObject        = __webpack_require__(35);
	
	// 22.1.3.4 Array.prototype.entries()
	// 22.1.3.13 Array.prototype.keys()
	// 22.1.3.29 Array.prototype.values()
	// 22.1.3.30 Array.prototype[@@iterator]()
	module.exports = __webpack_require__(10)(Array, 'Array', function(iterated, kind){
	  this._t = toIObject(iterated); // target
	  this._i = 0;                   // next index
	  this._k = kind;                // kind
	// 22.1.5.2.1 %ArrayIteratorPrototype%.next()
	}, function(){
	  var O     = this._t
	    , kind  = this._k
	    , index = this._i++;
	  if(!O || index >= O.length){
	    this._t = undefined;
	    return step(1);
	  }
	  if(kind == 'keys'  )return step(0, index);
	  if(kind == 'values')return step(0, O[index]);
	  return step(0, [index, O[index]]);
	}, 'values');
	
	// argumentsList[@@iterator] is %ArrayProto_values% (9.4.4.6, 9.4.4.7)
	Iterators.Arguments = Iterators.Array;
	
	addToUnscopables('keys');
	addToUnscopables('values');
	addToUnscopables('entries');

/***/ },
/* 52 */
/***/ function(module, exports) {

	module.exports = function(){ /* empty */ };

/***/ },
/* 53 */
/***/ function(module, exports) {

	module.exports = function(done, value){
	  return {value: value, done: !!done};
	};

/***/ },
/* 54 */
/***/ function(module, exports, __webpack_require__) {

	exports.f = __webpack_require__(47);

/***/ },
/* 55 */
/***/ function(module, exports, __webpack_require__) {

	module.exports = { "default": __webpack_require__(56), __esModule: true };

/***/ },
/* 56 */
/***/ function(module, exports, __webpack_require__) {

	__webpack_require__(57);
	__webpack_require__(68);
	__webpack_require__(69);
	__webpack_require__(70);
	module.exports = __webpack_require__(14).Symbol;

/***/ },
/* 57 */
/***/ function(module, exports, __webpack_require__) {

	'use strict';
	// ECMAScript 6 symbols shim
	var global         = __webpack_require__(13)
	  , has            = __webpack_require__(28)
	  , DESCRIPTORS    = __webpack_require__(22)
	  , $export        = __webpack_require__(12)
	  , redefine       = __webpack_require__(27)
	  , META           = __webpack_require__(58).KEY
	  , $fails         = __webpack_require__(23)
	  , shared         = __webpack_require__(42)
	  , setToStringTag = __webpack_require__(46)
	  , uid            = __webpack_require__(43)
	  , wks            = __webpack_require__(47)
	  , wksExt         = __webpack_require__(54)
	  , wksDefine      = __webpack_require__(59)
	  , keyOf          = __webpack_require__(60)
	  , enumKeys       = __webpack_require__(61)
	  , isArray        = __webpack_require__(64)
	  , anObject       = __webpack_require__(19)
	  , toIObject      = __webpack_require__(35)
	  , toPrimitive    = __webpack_require__(25)
	  , createDesc     = __webpack_require__(26)
	  , _create        = __webpack_require__(31)
	  , gOPNExt        = __webpack_require__(65)
	  , $GOPD          = __webpack_require__(67)
	  , $DP            = __webpack_require__(18)
	  , $keys          = __webpack_require__(33)
	  , gOPD           = $GOPD.f
	  , dP             = $DP.f
	  , gOPN           = gOPNExt.f
	  , $Symbol        = global.Symbol
	  , $JSON          = global.JSON
	  , _stringify     = $JSON && $JSON.stringify
	  , PROTOTYPE      = 'prototype'
	  , HIDDEN         = wks('_hidden')
	  , TO_PRIMITIVE   = wks('toPrimitive')
	  , isEnum         = {}.propertyIsEnumerable
	  , SymbolRegistry = shared('symbol-registry')
	  , AllSymbols     = shared('symbols')
	  , OPSymbols      = shared('op-symbols')
	  , ObjectProto    = Object[PROTOTYPE]
	  , USE_NATIVE     = typeof $Symbol == 'function'
	  , QObject        = global.QObject;
	// Don't use setters in Qt Script, https://github.com/zloirock/core-js/issues/173
	var setter = !QObject || !QObject[PROTOTYPE] || !QObject[PROTOTYPE].findChild;
	
	// fallback for old Android, https://code.google.com/p/v8/issues/detail?id=687
	var setSymbolDesc = DESCRIPTORS && $fails(function(){
	  return _create(dP({}, 'a', {
	    get: function(){ return dP(this, 'a', {value: 7}).a; }
	  })).a != 7;
	}) ? function(it, key, D){
	  var protoDesc = gOPD(ObjectProto, key);
	  if(protoDesc)delete ObjectProto[key];
	  dP(it, key, D);
	  if(protoDesc && it !== ObjectProto)dP(ObjectProto, key, protoDesc);
	} : dP;
	
	var wrap = function(tag){
	  var sym = AllSymbols[tag] = _create($Symbol[PROTOTYPE]);
	  sym._k = tag;
	  return sym;
	};
	
	var isSymbol = USE_NATIVE && typeof $Symbol.iterator == 'symbol' ? function(it){
	  return typeof it == 'symbol';
	} : function(it){
	  return it instanceof $Symbol;
	};
	
	var $defineProperty = function defineProperty(it, key, D){
	  if(it === ObjectProto)$defineProperty(OPSymbols, key, D);
	  anObject(it);
	  key = toPrimitive(key, true);
	  anObject(D);
	  if(has(AllSymbols, key)){
	    if(!D.enumerable){
	      if(!has(it, HIDDEN))dP(it, HIDDEN, createDesc(1, {}));
	      it[HIDDEN][key] = true;
	    } else {
	      if(has(it, HIDDEN) && it[HIDDEN][key])it[HIDDEN][key] = false;
	      D = _create(D, {enumerable: createDesc(0, false)});
	    } return setSymbolDesc(it, key, D);
	  } return dP(it, key, D);
	};
	var $defineProperties = function defineProperties(it, P){
	  anObject(it);
	  var keys = enumKeys(P = toIObject(P))
	    , i    = 0
	    , l = keys.length
	    , key;
	  while(l > i)$defineProperty(it, key = keys[i++], P[key]);
	  return it;
	};
	var $create = function create(it, P){
	  return P === undefined ? _create(it) : $defineProperties(_create(it), P);
	};
	var $propertyIsEnumerable = function propertyIsEnumerable(key){
	  var E = isEnum.call(this, key = toPrimitive(key, true));
	  if(this === ObjectProto && has(AllSymbols, key) && !has(OPSymbols, key))return false;
	  return E || !has(this, key) || !has(AllSymbols, key) || has(this, HIDDEN) && this[HIDDEN][key] ? E : true;
	};
	var $getOwnPropertyDescriptor = function getOwnPropertyDescriptor(it, key){
	  it  = toIObject(it);
	  key = toPrimitive(key, true);
	  if(it === ObjectProto && has(AllSymbols, key) && !has(OPSymbols, key))return;
	  var D = gOPD(it, key);
	  if(D && has(AllSymbols, key) && !(has(it, HIDDEN) && it[HIDDEN][key]))D.enumerable = true;
	  return D;
	};
	var $getOwnPropertyNames = function getOwnPropertyNames(it){
	  var names  = gOPN(toIObject(it))
	    , result = []
	    , i      = 0
	    , key;
	  while(names.length > i){
	    if(!has(AllSymbols, key = names[i++]) && key != HIDDEN && key != META)result.push(key);
	  } return result;
	};
	var $getOwnPropertySymbols = function getOwnPropertySymbols(it){
	  var IS_OP  = it === ObjectProto
	    , names  = gOPN(IS_OP ? OPSymbols : toIObject(it))
	    , result = []
	    , i      = 0
	    , key;
	  while(names.length > i){
	    if(has(AllSymbols, key = names[i++]) && (IS_OP ? has(ObjectProto, key) : true))result.push(AllSymbols[key]);
	  } return result;
	};
	
	// 19.4.1.1 Symbol([description])
	if(!USE_NATIVE){
	  $Symbol = function Symbol(){
	    if(this instanceof $Symbol)throw TypeError('Symbol is not a constructor!');
	    var tag = uid(arguments.length > 0 ? arguments[0] : undefined);
	    var $set = function(value){
	      if(this === ObjectProto)$set.call(OPSymbols, value);
	      if(has(this, HIDDEN) && has(this[HIDDEN], tag))this[HIDDEN][tag] = false;
	      setSymbolDesc(this, tag, createDesc(1, value));
	    };
	    if(DESCRIPTORS && setter)setSymbolDesc(ObjectProto, tag, {configurable: true, set: $set});
	    return wrap(tag);
	  };
	  redefine($Symbol[PROTOTYPE], 'toString', function toString(){
	    return this._k;
	  });
	
	  $GOPD.f = $getOwnPropertyDescriptor;
	  $DP.f   = $defineProperty;
	  __webpack_require__(66).f = gOPNExt.f = $getOwnPropertyNames;
	  __webpack_require__(63).f  = $propertyIsEnumerable;
	  __webpack_require__(62).f = $getOwnPropertySymbols;
	
	  if(DESCRIPTORS && !__webpack_require__(11)){
	    redefine(ObjectProto, 'propertyIsEnumerable', $propertyIsEnumerable, true);
	  }
	
	  wksExt.f = function(name){
	    return wrap(wks(name));
	  }
	}
	
	$export($export.G + $export.W + $export.F * !USE_NATIVE, {Symbol: $Symbol});
	
	for(var symbols = (
	  // 19.4.2.2, 19.4.2.3, 19.4.2.4, 19.4.2.6, 19.4.2.8, 19.4.2.9, 19.4.2.10, 19.4.2.11, 19.4.2.12, 19.4.2.13, 19.4.2.14
	  'hasInstance,isConcatSpreadable,iterator,match,replace,search,species,split,toPrimitive,toStringTag,unscopables'
	).split(','), i = 0; symbols.length > i; )wks(symbols[i++]);
	
	for(var symbols = $keys(wks.store), i = 0; symbols.length > i; )wksDefine(symbols[i++]);
	
	$export($export.S + $export.F * !USE_NATIVE, 'Symbol', {
	  // 19.4.2.1 Symbol.for(key)
	  'for': function(key){
	    return has(SymbolRegistry, key += '')
	      ? SymbolRegistry[key]
	      : SymbolRegistry[key] = $Symbol(key);
	  },
	  // 19.4.2.5 Symbol.keyFor(sym)
	  keyFor: function keyFor(key){
	    if(isSymbol(key))return keyOf(SymbolRegistry, key);
	    throw TypeError(key + ' is not a symbol!');
	  },
	  useSetter: function(){ setter = true; },
	  useSimple: function(){ setter = false; }
	});
	
	$export($export.S + $export.F * !USE_NATIVE, 'Object', {
	  // 19.1.2.2 Object.create(O [, Properties])
	  create: $create,
	  // 19.1.2.4 Object.defineProperty(O, P, Attributes)
	  defineProperty: $defineProperty,
	  // 19.1.2.3 Object.defineProperties(O, Properties)
	  defineProperties: $defineProperties,
	  // 19.1.2.6 Object.getOwnPropertyDescriptor(O, P)
	  getOwnPropertyDescriptor: $getOwnPropertyDescriptor,
	  // 19.1.2.7 Object.getOwnPropertyNames(O)
	  getOwnPropertyNames: $getOwnPropertyNames,
	  // 19.1.2.8 Object.getOwnPropertySymbols(O)
	  getOwnPropertySymbols: $getOwnPropertySymbols
	});
	
	// 24.3.2 JSON.stringify(value [, replacer [, space]])
	$JSON && $export($export.S + $export.F * (!USE_NATIVE || $fails(function(){
	  var S = $Symbol();
	  // MS Edge converts symbol values to JSON as {}
	  // WebKit converts symbol values to JSON as null
	  // V8 throws on boxed symbols
	  return _stringify([S]) != '[null]' || _stringify({a: S}) != '{}' || _stringify(Object(S)) != '{}';
	})), 'JSON', {
	  stringify: function stringify(it){
	    if(it === undefined || isSymbol(it))return; // IE8 returns string on undefined
	    var args = [it]
	      , i    = 1
	      , replacer, $replacer;
	    while(arguments.length > i)args.push(arguments[i++]);
	    replacer = args[1];
	    if(typeof replacer == 'function')$replacer = replacer;
	    if($replacer || !isArray(replacer))replacer = function(key, value){
	      if($replacer)value = $replacer.call(this, key, value);
	      if(!isSymbol(value))return value;
	    };
	    args[1] = replacer;
	    return _stringify.apply($JSON, args);
	  }
	});
	
	// 19.4.3.4 Symbol.prototype[@@toPrimitive](hint)
	$Symbol[PROTOTYPE][TO_PRIMITIVE] || __webpack_require__(17)($Symbol[PROTOTYPE], TO_PRIMITIVE, $Symbol[PROTOTYPE].valueOf);
	// 19.4.3.5 Symbol.prototype[@@toStringTag]
	setToStringTag($Symbol, 'Symbol');
	// 20.2.1.9 Math[@@toStringTag]
	setToStringTag(Math, 'Math', true);
	// 24.3.3 JSON[@@toStringTag]
	setToStringTag(global.JSON, 'JSON', true);

/***/ },
/* 58 */
/***/ function(module, exports, __webpack_require__) {

	var META     = __webpack_require__(43)('meta')
	  , isObject = __webpack_require__(20)
	  , has      = __webpack_require__(28)
	  , setDesc  = __webpack_require__(18).f
	  , id       = 0;
	var isExtensible = Object.isExtensible || function(){
	  return true;
	};
	var FREEZE = !__webpack_require__(23)(function(){
	  return isExtensible(Object.preventExtensions({}));
	});
	var setMeta = function(it){
	  setDesc(it, META, {value: {
	    i: 'O' + ++id, // object ID
	    w: {}          // weak collections IDs
	  }});
	};
	var fastKey = function(it, create){
	  // return primitive with prefix
	  if(!isObject(it))return typeof it == 'symbol' ? it : (typeof it == 'string' ? 'S' : 'P') + it;
	  if(!has(it, META)){
	    // can't set metadata to uncaught frozen object
	    if(!isExtensible(it))return 'F';
	    // not necessary to add metadata
	    if(!create)return 'E';
	    // add missing metadata
	    setMeta(it);
	  // return object ID
	  } return it[META].i;
	};
	var getWeak = function(it, create){
	  if(!has(it, META)){
	    // can't set metadata to uncaught frozen object
	    if(!isExtensible(it))return true;
	    // not necessary to add metadata
	    if(!create)return false;
	    // add missing metadata
	    setMeta(it);
	  // return hash weak collections IDs
	  } return it[META].w;
	};
	// add metadata on freeze-family methods calling
	var onFreeze = function(it){
	  if(FREEZE && meta.NEED && isExtensible(it) && !has(it, META))setMeta(it);
	  return it;
	};
	var meta = module.exports = {
	  KEY:      META,
	  NEED:     false,
	  fastKey:  fastKey,
	  getWeak:  getWeak,
	  onFreeze: onFreeze
	};

/***/ },
/* 59 */
/***/ function(module, exports, __webpack_require__) {

	var global         = __webpack_require__(13)
	  , core           = __webpack_require__(14)
	  , LIBRARY        = __webpack_require__(11)
	  , wksExt         = __webpack_require__(54)
	  , defineProperty = __webpack_require__(18).f;
	module.exports = function(name){
	  var $Symbol = core.Symbol || (core.Symbol = LIBRARY ? {} : global.Symbol || {});
	  if(name.charAt(0) != '_' && !(name in $Symbol))defineProperty($Symbol, name, {value: wksExt.f(name)});
	};

/***/ },
/* 60 */
/***/ function(module, exports, __webpack_require__) {

	var getKeys   = __webpack_require__(33)
	  , toIObject = __webpack_require__(35);
	module.exports = function(object, el){
	  var O      = toIObject(object)
	    , keys   = getKeys(O)
	    , length = keys.length
	    , index  = 0
	    , key;
	  while(length > index)if(O[key = keys[index++]] === el)return key;
	};

/***/ },
/* 61 */
/***/ function(module, exports, __webpack_require__) {

	// all enumerable object keys, includes symbols
	var getKeys = __webpack_require__(33)
	  , gOPS    = __webpack_require__(62)
	  , pIE     = __webpack_require__(63);
	module.exports = function(it){
	  var result     = getKeys(it)
	    , getSymbols = gOPS.f;
	  if(getSymbols){
	    var symbols = getSymbols(it)
	      , isEnum  = pIE.f
	      , i       = 0
	      , key;
	    while(symbols.length > i)if(isEnum.call(it, key = symbols[i++]))result.push(key);
	  } return result;
	};

/***/ },
/* 62 */
/***/ function(module, exports) {

	exports.f = Object.getOwnPropertySymbols;

/***/ },
/* 63 */
/***/ function(module, exports) {

	exports.f = {}.propertyIsEnumerable;

/***/ },
/* 64 */
/***/ function(module, exports, __webpack_require__) {

	// 7.2.2 IsArray(argument)
	var cof = __webpack_require__(37);
	module.exports = Array.isArray || function isArray(arg){
	  return cof(arg) == 'Array';
	};

/***/ },
/* 65 */
/***/ function(module, exports, __webpack_require__) {

	// fallback for IE11 buggy Object.getOwnPropertyNames with iframe and window
	var toIObject = __webpack_require__(35)
	  , gOPN      = __webpack_require__(66).f
	  , toString  = {}.toString;
	
	var windowNames = typeof window == 'object' && window && Object.getOwnPropertyNames
	  ? Object.getOwnPropertyNames(window) : [];
	
	var getWindowNames = function(it){
	  try {
	    return gOPN(it);
	  } catch(e){
	    return windowNames.slice();
	  }
	};
	
	module.exports.f = function getOwnPropertyNames(it){
	  return windowNames && toString.call(it) == '[object Window]' ? getWindowNames(it) : gOPN(toIObject(it));
	};


/***/ },
/* 66 */
/***/ function(module, exports, __webpack_require__) {

	// 19.1.2.7 / 15.2.3.4 Object.getOwnPropertyNames(O)
	var $keys      = __webpack_require__(34)
	  , hiddenKeys = __webpack_require__(44).concat('length', 'prototype');
	
	exports.f = Object.getOwnPropertyNames || function getOwnPropertyNames(O){
	  return $keys(O, hiddenKeys);
	};

/***/ },
/* 67 */
/***/ function(module, exports, __webpack_require__) {

	var pIE            = __webpack_require__(63)
	  , createDesc     = __webpack_require__(26)
	  , toIObject      = __webpack_require__(35)
	  , toPrimitive    = __webpack_require__(25)
	  , has            = __webpack_require__(28)
	  , IE8_DOM_DEFINE = __webpack_require__(21)
	  , gOPD           = Object.getOwnPropertyDescriptor;
	
	exports.f = __webpack_require__(22) ? gOPD : function getOwnPropertyDescriptor(O, P){
	  O = toIObject(O);
	  P = toPrimitive(P, true);
	  if(IE8_DOM_DEFINE)try {
	    return gOPD(O, P);
	  } catch(e){ /* empty */ }
	  if(has(O, P))return createDesc(!pIE.f.call(O, P), O[P]);
	};

/***/ },
/* 68 */
/***/ function(module, exports) {



/***/ },
/* 69 */
/***/ function(module, exports, __webpack_require__) {

	__webpack_require__(59)('asyncIterator');

/***/ },
/* 70 */
/***/ function(module, exports, __webpack_require__) {

	__webpack_require__(59)('observable');

/***/ },
/* 71 */,
/* 72 */,
/* 73 */,
/* 74 */,
/* 75 */,
/* 76 */,
/* 77 */,
/* 78 */
/***/ function(module, exports, __webpack_require__) {

	/* WEBPACK VAR INJECTION */(function(global) {'use strict';
	
	var _classCallCheck2 = __webpack_require__(79);
	
	var _classCallCheck3 = _interopRequireDefault(_classCallCheck2);
	
	var _createClass2 = __webpack_require__(80);
	
	var _createClass3 = _interopRequireDefault(_createClass2);
	
	var _slider = __webpack_require__(84);
	
	var _ui = __webpack_require__(107);
	
	function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }
	
	// import {Sendform} from '../libs/sendform/sendform2';
	// import { MfPopup } from '../libs/popup/mfpopup';
	// import { AjaxPopup } from '../libs/popup/ajaxPopup';
	// import { MagicPopup } from '../libs/popup/magicPopup';
	// import {Filter} from '../libs/filter';
	// import { GoogleMap } from '../libs/maps/google_map';
	$(document).ready(function () {
	    if (true) {
	        console.log('its dev mode use prod mode for production');
	    }
	    var projectApp = new App();
	    global.app = projectApp;
	    projectApp.init();
	});
	
	var App = function () {
	    // Define global visible variable inside app 
	    function App() {
	        (0, _classCallCheck3.default)(this, App);
	    }
	
	    (0, _createClass3.default)(App, [{
	        key: 'init',
	        value: function init() {
	            //used in Product slider block (Product page)
	            _ui.ui.galleryPopupInit('.js_gallery-product');
	
	            new _slider.Slider('.js_slider-main', {
	                nav: true,
	                dots: true,
	                items: 4,
	                margin: 10
	            });
	
	            new _slider.Slider('.js_slider-product', {
	                nav: false,
	                dots: true,
	                items: 1,
	                touchDrag: false,
	                mouseDrag: false,
	                dotsContainer: '.js_product-slider-dots-container'
	            });
	
	            // new GoogleMap({
	            //    identifier:'#map-google',
	            //    dataFromView: false,
	            //    center:[55.618583, 37.394107],
	            //    zoom: 16,
	            //    placemarks:[
	            //        {
	            //            coordinate: [55.618583, 37.394107],
	            //            hint:' Москва, Киевское шоссе, 5 км от МКАД',
	            //            iconColor: 'red',
	            //            baloonCnt: 'safsafa'
	            //        },
	            //        {
	            //            coordinate: [55.6182383, 37.395507],
	            //            hint:' Rsfa, Киевское шоссе, 5 км от МКАД',
	            //        }
	            //    ]
	            // });
	        }
	    }]);
	    return App;
	}();
	
	;
	/* WEBPACK VAR INJECTION */}.call(exports, (function() { return this; }())))

/***/ },
/* 79 */
/***/ function(module, exports) {

	"use strict";
	
	exports.__esModule = true;
	
	exports.default = function (instance, Constructor) {
	  if (!(instance instanceof Constructor)) {
	    throw new TypeError("Cannot call a class as a function");
	  }
	};

/***/ },
/* 80 */
/***/ function(module, exports, __webpack_require__) {

	"use strict";
	
	exports.__esModule = true;
	
	var _defineProperty = __webpack_require__(81);
	
	var _defineProperty2 = _interopRequireDefault(_defineProperty);
	
	function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }
	
	exports.default = function () {
	  function defineProperties(target, props) {
	    for (var i = 0; i < props.length; i++) {
	      var descriptor = props[i];
	      descriptor.enumerable = descriptor.enumerable || false;
	      descriptor.configurable = true;
	      if ("value" in descriptor) descriptor.writable = true;
	      (0, _defineProperty2.default)(target, descriptor.key, descriptor);
	    }
	  }
	
	  return function (Constructor, protoProps, staticProps) {
	    if (protoProps) defineProperties(Constructor.prototype, protoProps);
	    if (staticProps) defineProperties(Constructor, staticProps);
	    return Constructor;
	  };
	}();

/***/ },
/* 81 */
/***/ function(module, exports, __webpack_require__) {

	module.exports = { "default": __webpack_require__(82), __esModule: true };

/***/ },
/* 82 */
/***/ function(module, exports, __webpack_require__) {

	__webpack_require__(83);
	var $Object = __webpack_require__(14).Object;
	module.exports = function defineProperty(it, key, desc){
	  return $Object.defineProperty(it, key, desc);
	};

/***/ },
/* 83 */
/***/ function(module, exports, __webpack_require__) {

	var $export = __webpack_require__(12);
	// 19.1.2.4 / 15.2.3.6 Object.defineProperty(O, P, Attributes)
	$export($export.S + $export.F * !__webpack_require__(22), 'Object', {defineProperty: __webpack_require__(18).f});

/***/ },
/* 84 */
/***/ function(module, exports, __webpack_require__) {

	'use strict';
	
	Object.defineProperty(exports, "__esModule", {
	    value: true
	});
	exports.Slider = undefined;
	
	var _assign = __webpack_require__(85);
	
	var _assign2 = _interopRequireDefault(_assign);
	
	var _getPrototypeOf = __webpack_require__(89);
	
	var _getPrototypeOf2 = _interopRequireDefault(_getPrototypeOf);
	
	var _classCallCheck2 = __webpack_require__(79);
	
	var _classCallCheck3 = _interopRequireDefault(_classCallCheck2);
	
	var _createClass2 = __webpack_require__(80);
	
	var _createClass3 = _interopRequireDefault(_createClass2);
	
	var _possibleConstructorReturn2 = __webpack_require__(93);
	
	var _possibleConstructorReturn3 = _interopRequireDefault(_possibleConstructorReturn2);
	
	var _inherits2 = __webpack_require__(94);
	
	var _inherits3 = _interopRequireDefault(_inherits2);
	
	__webpack_require__(102);
	
	var _component = __webpack_require__(106);
	
	function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }
	
	/**
	 * Owl carousel slider class.
	 */
	var defaultSetting = {
	    loop: true,
	    margin: 0,
	    items: 1,
	    nav: true,
	    autoPlay: true,
	    stopOnHover: true,
	    navText: ['', '']
	};
	/**
	 * Class for init slider.
	 *
	 */
	
	var Slider = exports.Slider = function (_Component) {
	    (0, _inherits3.default)(Slider, _Component);
	
	    /**
	     * @param el{string} - slider class.
	     * @param settings{Object} - settings.
	     * @param plugin{string} - plugin define.
	     */
	    function Slider() {
	        var el = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : '.js_owl-carousel';
	        var settings = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : defaultSetting;
	        var plugin = arguments.length > 2 && arguments[2] !== undefined ? arguments[2] : 'owlCarousel';
	        (0, _classCallCheck3.default)(this, Slider);
	
	        var _this = (0, _possibleConstructorReturn3.default)(this, (Slider.__proto__ || (0, _getPrototypeOf2.default)(Slider)).call(this, el));
	
	        _this.settings = (0, _assign2.default)(defaultSetting, settings);
	        _this.plugin = plugin;
	        if (!_this.errors) {
	            _this.initSlider();
	        }
	        return _this;
	    }
	
	    /**
	     * Set new plugin.
	     *
	     * @param plugin{string} - name of function which init plugin.
	     */
	
	
	    (0, _createClass3.default)(Slider, [{
	        key: 'initSlider',
	
	
	        /**
	         * Initialize slider with owlCarousel.
	         */
	        value: function initSlider() {
	            this.sliderPlugin.call(this.element, this.settings);
	        }
	    }, {
	        key: 'plugin',
	        set: function set(plugin) {
	            plugin = jQuery()[plugin];
	            if (plugin == undefined) {
	                console.error('Error in Slider: plugin of slider is not defined.');
	                return;
	            }
	            this.sliderPlugin = plugin;
	        }
	    }]);
	    return Slider;
	}(_component.Component);

/***/ },
/* 85 */
/***/ function(module, exports, __webpack_require__) {

	module.exports = { "default": __webpack_require__(86), __esModule: true };

/***/ },
/* 86 */
/***/ function(module, exports, __webpack_require__) {

	__webpack_require__(87);
	module.exports = __webpack_require__(14).Object.assign;

/***/ },
/* 87 */
/***/ function(module, exports, __webpack_require__) {

	// 19.1.3.1 Object.assign(target, source)
	var $export = __webpack_require__(12);
	
	$export($export.S + $export.F, 'Object', {assign: __webpack_require__(88)});

/***/ },
/* 88 */
/***/ function(module, exports, __webpack_require__) {

	'use strict';
	// 19.1.2.1 Object.assign(target, source, ...)
	var getKeys  = __webpack_require__(33)
	  , gOPS     = __webpack_require__(62)
	  , pIE      = __webpack_require__(63)
	  , toObject = __webpack_require__(49)
	  , IObject  = __webpack_require__(36)
	  , $assign  = Object.assign;
	
	// should work with symbols and should have deterministic property order (V8 bug)
	module.exports = !$assign || __webpack_require__(23)(function(){
	  var A = {}
	    , B = {}
	    , S = Symbol()
	    , K = 'abcdefghijklmnopqrst';
	  A[S] = 7;
	  K.split('').forEach(function(k){ B[k] = k; });
	  return $assign({}, A)[S] != 7 || Object.keys($assign({}, B)).join('') != K;
	}) ? function assign(target, source){ // eslint-disable-line no-unused-vars
	  var T     = toObject(target)
	    , aLen  = arguments.length
	    , index = 1
	    , getSymbols = gOPS.f
	    , isEnum     = pIE.f;
	  while(aLen > index){
	    var S      = IObject(arguments[index++])
	      , keys   = getSymbols ? getKeys(S).concat(getSymbols(S)) : getKeys(S)
	      , length = keys.length
	      , j      = 0
	      , key;
	    while(length > j)if(isEnum.call(S, key = keys[j++]))T[key] = S[key];
	  } return T;
	} : $assign;

/***/ },
/* 89 */
/***/ function(module, exports, __webpack_require__) {

	module.exports = { "default": __webpack_require__(90), __esModule: true };

/***/ },
/* 90 */
/***/ function(module, exports, __webpack_require__) {

	__webpack_require__(91);
	module.exports = __webpack_require__(14).Object.getPrototypeOf;

/***/ },
/* 91 */
/***/ function(module, exports, __webpack_require__) {

	// 19.1.2.9 Object.getPrototypeOf(O)
	var toObject        = __webpack_require__(49)
	  , $getPrototypeOf = __webpack_require__(48);
	
	__webpack_require__(92)('getPrototypeOf', function(){
	  return function getPrototypeOf(it){
	    return $getPrototypeOf(toObject(it));
	  };
	});

/***/ },
/* 92 */
/***/ function(module, exports, __webpack_require__) {

	// most Object methods by ES6 should accept primitives
	var $export = __webpack_require__(12)
	  , core    = __webpack_require__(14)
	  , fails   = __webpack_require__(23);
	module.exports = function(KEY, exec){
	  var fn  = (core.Object || {})[KEY] || Object[KEY]
	    , exp = {};
	  exp[KEY] = exec(fn);
	  $export($export.S + $export.F * fails(function(){ fn(1); }), 'Object', exp);
	};

/***/ },
/* 93 */
/***/ function(module, exports, __webpack_require__) {

	"use strict";
	
	exports.__esModule = true;
	
	var _typeof2 = __webpack_require__(3);
	
	var _typeof3 = _interopRequireDefault(_typeof2);
	
	function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }
	
	exports.default = function (self, call) {
	  if (!self) {
	    throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
	  }
	
	  return call && ((typeof call === "undefined" ? "undefined" : (0, _typeof3.default)(call)) === "object" || typeof call === "function") ? call : self;
	};

/***/ },
/* 94 */
/***/ function(module, exports, __webpack_require__) {

	"use strict";
	
	exports.__esModule = true;
	
	var _setPrototypeOf = __webpack_require__(95);
	
	var _setPrototypeOf2 = _interopRequireDefault(_setPrototypeOf);
	
	var _create = __webpack_require__(99);
	
	var _create2 = _interopRequireDefault(_create);
	
	var _typeof2 = __webpack_require__(3);
	
	var _typeof3 = _interopRequireDefault(_typeof2);
	
	function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }
	
	exports.default = function (subClass, superClass) {
	  if (typeof superClass !== "function" && superClass !== null) {
	    throw new TypeError("Super expression must either be null or a function, not " + (typeof superClass === "undefined" ? "undefined" : (0, _typeof3.default)(superClass)));
	  }
	
	  subClass.prototype = (0, _create2.default)(superClass && superClass.prototype, {
	    constructor: {
	      value: subClass,
	      enumerable: false,
	      writable: true,
	      configurable: true
	    }
	  });
	  if (superClass) _setPrototypeOf2.default ? (0, _setPrototypeOf2.default)(subClass, superClass) : subClass.__proto__ = superClass;
	};

/***/ },
/* 95 */
/***/ function(module, exports, __webpack_require__) {

	module.exports = { "default": __webpack_require__(96), __esModule: true };

/***/ },
/* 96 */
/***/ function(module, exports, __webpack_require__) {

	__webpack_require__(97);
	module.exports = __webpack_require__(14).Object.setPrototypeOf;

/***/ },
/* 97 */
/***/ function(module, exports, __webpack_require__) {

	// 19.1.3.19 Object.setPrototypeOf(O, proto)
	var $export = __webpack_require__(12);
	$export($export.S, 'Object', {setPrototypeOf: __webpack_require__(98).set});

/***/ },
/* 98 */
/***/ function(module, exports, __webpack_require__) {

	// Works with __proto__ only. Old v8 can't work with null proto objects.
	/* eslint-disable no-proto */
	var isObject = __webpack_require__(20)
	  , anObject = __webpack_require__(19);
	var check = function(O, proto){
	  anObject(O);
	  if(!isObject(proto) && proto !== null)throw TypeError(proto + ": can't set as prototype!");
	};
	module.exports = {
	  set: Object.setPrototypeOf || ('__proto__' in {} ? // eslint-disable-line
	    function(test, buggy, set){
	      try {
	        set = __webpack_require__(15)(Function.call, __webpack_require__(67).f(Object.prototype, '__proto__').set, 2);
	        set(test, []);
	        buggy = !(test instanceof Array);
	      } catch(e){ buggy = true; }
	      return function setPrototypeOf(O, proto){
	        check(O, proto);
	        if(buggy)O.__proto__ = proto;
	        else set(O, proto);
	        return O;
	      };
	    }({}, false) : undefined),
	  check: check
	};

/***/ },
/* 99 */
/***/ function(module, exports, __webpack_require__) {

	module.exports = { "default": __webpack_require__(100), __esModule: true };

/***/ },
/* 100 */
/***/ function(module, exports, __webpack_require__) {

	__webpack_require__(101);
	var $Object = __webpack_require__(14).Object;
	module.exports = function create(P, D){
	  return $Object.create(P, D);
	};

/***/ },
/* 101 */
/***/ function(module, exports, __webpack_require__) {

	var $export = __webpack_require__(12)
	// 19.1.2.2 / 15.2.3.5 Object.create(O [, Properties])
	$export($export.S, 'Object', {create: __webpack_require__(31)});

/***/ },
/* 102 */
/***/ function(module, exports, __webpack_require__) {

	"use strict";
	
	var _getOwnPropertyNames = __webpack_require__(103);
	
	var _getOwnPropertyNames2 = _interopRequireDefault(_getOwnPropertyNames);
	
	var _typeof2 = __webpack_require__(3);
	
	var _typeof3 = _interopRequireDefault(_typeof2);
	
	function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }
	
	/**
	 * Owl Carousel v2.2.1
	 * Copyright 2013-2017 David Deutsch
	 * Licensed under  ()
	 */
	!function (a, b, c, d) {
	  function e(b, c) {
	    this.settings = null, this.options = a.extend({}, e.Defaults, c), this.$element = a(b), this._handlers = {}, this._plugins = {}, this._supress = {}, this._current = null, this._speed = null, this._coordinates = [], this._breakpoint = null, this._width = null, this._items = [], this._clones = [], this._mergers = [], this._widths = [], this._invalidated = {}, this._pipe = [], this._drag = { time: null, target: null, pointer: null, stage: { start: null, current: null }, direction: null }, this._states = { current: {}, tags: { initializing: ["busy"], animating: ["busy"], dragging: ["interacting"] } }, a.each(["onResize", "onThrottledResize"], a.proxy(function (b, c) {
	      this._handlers[c] = a.proxy(this[c], this);
	    }, this)), a.each(e.Plugins, a.proxy(function (a, b) {
	      this._plugins[a.charAt(0).toLowerCase() + a.slice(1)] = new b(this);
	    }, this)), a.each(e.Workers, a.proxy(function (b, c) {
	      this._pipe.push({ filter: c.filter, run: a.proxy(c.run, this) });
	    }, this)), this.setup(), this.initialize();
	  }e.Defaults = { items: 3, loop: !1, center: !1, rewind: !1, mouseDrag: !0, touchDrag: !0, pullDrag: !0, freeDrag: !1, margin: 0, stagePadding: 0, merge: !1, mergeFit: !0, autoWidth: !1, startPosition: 0, rtl: !1, smartSpeed: 250, fluidSpeed: !1, dragEndSpeed: !1, responsive: {}, responsiveRefreshRate: 200, responsiveBaseElement: b, fallbackEasing: "swing", info: !1, nestedItemSelector: !1, itemElement: "div", stageElement: "div", refreshClass: "owl-refresh", loadedClass: "owl-loaded", loadingClass: "owl-loading", rtlClass: "owl-rtl", responsiveClass: "owl-responsive", dragClass: "owl-drag", itemClass: "owl-item", stageClass: "owl-stage", stageOuterClass: "owl-stage-outer", grabClass: "owl-grab" }, e.Width = { Default: "default", Inner: "inner", Outer: "outer" }, e.Type = { Event: "event", State: "state" }, e.Plugins = {}, e.Workers = [{ filter: ["width", "settings"], run: function run() {
	      this._width = this.$element.width();
	    } }, { filter: ["width", "items", "settings"], run: function run(a) {
	      a.current = this._items && this._items[this.relative(this._current)];
	    } }, { filter: ["items", "settings"], run: function run() {
	      this.$stage.children(".cloned").remove();
	    } }, { filter: ["width", "items", "settings"], run: function run(a) {
	      var b = this.settings.margin || "",
	          c = !this.settings.autoWidth,
	          d = this.settings.rtl,
	          e = { width: "auto", "margin-left": d ? b : "", "margin-right": d ? "" : b };!c && this.$stage.children().css(e), a.css = e;
	    } }, { filter: ["width", "items", "settings"], run: function run(a) {
	      var b = (this.width() / this.settings.items).toFixed(3) - this.settings.margin,
	          c = null,
	          d = this._items.length,
	          e = !this.settings.autoWidth,
	          f = [];for (a.items = { merge: !1, width: b }; d--;) {
	        c = this._mergers[d], c = this.settings.mergeFit && Math.min(c, this.settings.items) || c, a.items.merge = c > 1 || a.items.merge, f[d] = e ? b * c : this._items[d].width();
	      }this._widths = f;
	    } }, { filter: ["items", "settings"], run: function run() {
	      var b = [],
	          c = this._items,
	          d = this.settings,
	          e = Math.max(2 * d.items, 4),
	          f = 2 * Math.ceil(c.length / 2),
	          g = d.loop && c.length ? d.rewind ? e : Math.max(e, f) : 0,
	          h = "",
	          i = "";for (g /= 2; g--;) {
	        b.push(this.normalize(b.length / 2, !0)), h += c[b[b.length - 1]][0].outerHTML, b.push(this.normalize(c.length - 1 - (b.length - 1) / 2, !0)), i = c[b[b.length - 1]][0].outerHTML + i;
	      }this._clones = b, a(h).addClass("cloned").appendTo(this.$stage), a(i).addClass("cloned").prependTo(this.$stage);
	    } }, { filter: ["width", "items", "settings"], run: function run() {
	      for (var a = this.settings.rtl ? 1 : -1, b = this._clones.length + this._items.length, c = -1, d = 0, e = 0, f = []; ++c < b;) {
	        d = f[c - 1] || 0, e = this._widths[this.relative(c)] + this.settings.margin, f.push(d + e * a);
	      }this._coordinates = f;
	    } }, { filter: ["width", "items", "settings"], run: function run() {
	      var a = this.settings.stagePadding,
	          b = this._coordinates,
	          c = { width: Math.ceil(Math.abs(b[b.length - 1])) + 2 * a, "padding-left": a || "", "padding-right": a || "" };this.$stage.css(c);
	    } }, { filter: ["width", "items", "settings"], run: function run(a) {
	      var b = this._coordinates.length,
	          c = !this.settings.autoWidth,
	          d = this.$stage.children();if (c && a.items.merge) for (; b--;) {
	        a.css.width = this._widths[this.relative(b)], d.eq(b).css(a.css);
	      } else c && (a.css.width = a.items.width, d.css(a.css));
	    } }, { filter: ["items"], run: function run() {
	      this._coordinates.length < 1 && this.$stage.removeAttr("style");
	    } }, { filter: ["width", "items", "settings"], run: function run(a) {
	      a.current = a.current ? this.$stage.children().index(a.current) : 0, a.current = Math.max(this.minimum(), Math.min(this.maximum(), a.current)), this.reset(a.current);
	    } }, { filter: ["position"], run: function run() {
	      this.animate(this.coordinates(this._current));
	    } }, { filter: ["width", "position", "items", "settings"], run: function run() {
	      var a,
	          b,
	          c,
	          d,
	          e = this.settings.rtl ? 1 : -1,
	          f = 2 * this.settings.stagePadding,
	          g = this.coordinates(this.current()) + f,
	          h = g + this.width() * e,
	          i = [];for (c = 0, d = this._coordinates.length; c < d; c++) {
	        a = this._coordinates[c - 1] || 0, b = Math.abs(this._coordinates[c]) + f * e, (this.op(a, "<=", g) && this.op(a, ">", h) || this.op(b, "<", g) && this.op(b, ">", h)) && i.push(c);
	      }this.$stage.children(".active").removeClass("active"), this.$stage.children(":eq(" + i.join("), :eq(") + ")").addClass("active"), this.settings.center && (this.$stage.children(".center").removeClass("center"), this.$stage.children().eq(this.current()).addClass("center"));
	    } }], e.prototype.initialize = function () {
	    if (this.enter("initializing"), this.trigger("initialize"), this.$element.toggleClass(this.settings.rtlClass, this.settings.rtl), this.settings.autoWidth && !this.is("pre-loading")) {
	      var b, c, e;b = this.$element.find("img"), c = this.settings.nestedItemSelector ? "." + this.settings.nestedItemSelector : d, e = this.$element.children(c).width(), b.length && e <= 0 && this.preloadAutoWidthImages(b);
	    }this.$element.addClass(this.options.loadingClass), this.$stage = a("<" + this.settings.stageElement + ' class="' + this.settings.stageClass + '"/>').wrap('<div class="' + this.settings.stageOuterClass + '"/>'), this.$element.append(this.$stage.parent()), this.replace(this.$element.children().not(this.$stage.parent())), this.$element.is(":visible") ? this.refresh() : this.invalidate("width"), this.$element.removeClass(this.options.loadingClass).addClass(this.options.loadedClass), this.registerEventHandlers(), this.leave("initializing"), this.trigger("initialized");
	  }, e.prototype.setup = function () {
	    var b = this.viewport(),
	        c = this.options.responsive,
	        d = -1,
	        e = null;c ? (a.each(c, function (a) {
	      a <= b && a > d && (d = Number(a));
	    }), e = a.extend({}, this.options, c[d]), "function" == typeof e.stagePadding && (e.stagePadding = e.stagePadding()), delete e.responsive, e.responsiveClass && this.$element.attr("class", this.$element.attr("class").replace(new RegExp("(" + this.options.responsiveClass + "-)\\S+\\s", "g"), "$1" + d))) : e = a.extend({}, this.options), this.trigger("change", { property: { name: "settings", value: e } }), this._breakpoint = d, this.settings = e, this.invalidate("settings"), this.trigger("changed", { property: { name: "settings", value: this.settings } });
	  }, e.prototype.optionsLogic = function () {
	    this.settings.autoWidth && (this.settings.stagePadding = !1, this.settings.merge = !1);
	  }, e.prototype.prepare = function (b) {
	    var c = this.trigger("prepare", { content: b });return c.data || (c.data = a("<" + this.settings.itemElement + "/>").addClass(this.options.itemClass).append(b)), this.trigger("prepared", { content: c.data }), c.data;
	  }, e.prototype.update = function () {
	    for (var b = 0, c = this._pipe.length, d = a.proxy(function (a) {
	      return this[a];
	    }, this._invalidated), e = {}; b < c;) {
	      (this._invalidated.all || a.grep(this._pipe[b].filter, d).length > 0) && this._pipe[b].run(e), b++;
	    }this._invalidated = {}, !this.is("valid") && this.enter("valid");
	  }, e.prototype.width = function (a) {
	    switch (a = a || e.Width.Default) {case e.Width.Inner:case e.Width.Outer:
	        return this._width;default:
	        return this._width - 2 * this.settings.stagePadding + this.settings.margin;}
	  }, e.prototype.refresh = function () {
	    this.enter("refreshing"), this.trigger("refresh"), this.setup(), this.optionsLogic(), this.$element.addClass(this.options.refreshClass), this.update(), this.$element.removeClass(this.options.refreshClass), this.leave("refreshing"), this.trigger("refreshed");
	  }, e.prototype.onThrottledResize = function () {
	    b.clearTimeout(this.resizeTimer), this.resizeTimer = b.setTimeout(this._handlers.onResize, this.settings.responsiveRefreshRate);
	  }, e.prototype.onResize = function () {
	    return !!this._items.length && this._width !== this.$element.width() && !!this.$element.is(":visible") && (this.enter("resizing"), this.trigger("resize").isDefaultPrevented() ? (this.leave("resizing"), !1) : (this.invalidate("width"), this.refresh(), this.leave("resizing"), void this.trigger("resized")));
	  }, e.prototype.registerEventHandlers = function () {
	    a.support.transition && this.$stage.on(a.support.transition.end + ".owl.core", a.proxy(this.onTransitionEnd, this)), this.settings.responsive !== !1 && this.on(b, "resize", this._handlers.onThrottledResize), this.settings.mouseDrag && (this.$element.addClass(this.options.dragClass), this.$stage.on("mousedown.owl.core", a.proxy(this.onDragStart, this)), this.$stage.on("dragstart.owl.core selectstart.owl.core", function () {
	      return !1;
	    })), this.settings.touchDrag && (this.$stage.on("touchstart.owl.core", a.proxy(this.onDragStart, this)), this.$stage.on("touchcancel.owl.core", a.proxy(this.onDragEnd, this)));
	  }, e.prototype.onDragStart = function (b) {
	    var d = null;3 !== b.which && (a.support.transform ? (d = this.$stage.css("transform").replace(/.*\(|\)| /g, "").split(","), d = { x: d[16 === d.length ? 12 : 4], y: d[16 === d.length ? 13 : 5] }) : (d = this.$stage.position(), d = { x: this.settings.rtl ? d.left + this.$stage.width() - this.width() + this.settings.margin : d.left, y: d.top }), this.is("animating") && (a.support.transform ? this.animate(d.x) : this.$stage.stop(), this.invalidate("position")), this.$element.toggleClass(this.options.grabClass, "mousedown" === b.type), this.speed(0), this._drag.time = new Date().getTime(), this._drag.target = a(b.target), this._drag.stage.start = d, this._drag.stage.current = d, this._drag.pointer = this.pointer(b), a(c).on("mouseup.owl.core touchend.owl.core", a.proxy(this.onDragEnd, this)), a(c).one("mousemove.owl.core touchmove.owl.core", a.proxy(function (b) {
	      var d = this.difference(this._drag.pointer, this.pointer(b));a(c).on("mousemove.owl.core touchmove.owl.core", a.proxy(this.onDragMove, this)), Math.abs(d.x) < Math.abs(d.y) && this.is("valid") || (b.preventDefault(), this.enter("dragging"), this.trigger("drag"));
	    }, this)));
	  }, e.prototype.onDragMove = function (a) {
	    var b = null,
	        c = null,
	        d = null,
	        e = this.difference(this._drag.pointer, this.pointer(a)),
	        f = this.difference(this._drag.stage.start, e);this.is("dragging") && (a.preventDefault(), this.settings.loop ? (b = this.coordinates(this.minimum()), c = this.coordinates(this.maximum() + 1) - b, f.x = ((f.x - b) % c + c) % c + b) : (b = this.settings.rtl ? this.coordinates(this.maximum()) : this.coordinates(this.minimum()), c = this.settings.rtl ? this.coordinates(this.minimum()) : this.coordinates(this.maximum()), d = this.settings.pullDrag ? -1 * e.x / 5 : 0, f.x = Math.max(Math.min(f.x, b + d), c + d)), this._drag.stage.current = f, this.animate(f.x));
	  }, e.prototype.onDragEnd = function (b) {
	    var d = this.difference(this._drag.pointer, this.pointer(b)),
	        e = this._drag.stage.current,
	        f = d.x > 0 ^ this.settings.rtl ? "left" : "right";a(c).off(".owl.core"), this.$element.removeClass(this.options.grabClass), (0 !== d.x && this.is("dragging") || !this.is("valid")) && (this.speed(this.settings.dragEndSpeed || this.settings.smartSpeed), this.current(this.closest(e.x, 0 !== d.x ? f : this._drag.direction)), this.invalidate("position"), this.update(), this._drag.direction = f, (Math.abs(d.x) > 3 || new Date().getTime() - this._drag.time > 300) && this._drag.target.one("click.owl.core", function () {
	      return !1;
	    })), this.is("dragging") && (this.leave("dragging"), this.trigger("dragged"));
	  }, e.prototype.closest = function (b, c) {
	    var d = -1,
	        e = 30,
	        f = this.width(),
	        g = this.coordinates();return this.settings.freeDrag || a.each(g, a.proxy(function (a, h) {
	      return "left" === c && b > h - e && b < h + e ? d = a : "right" === c && b > h - f - e && b < h - f + e ? d = a + 1 : this.op(b, "<", h) && this.op(b, ">", g[a + 1] || h - f) && (d = "left" === c ? a + 1 : a), d === -1;
	    }, this)), this.settings.loop || (this.op(b, ">", g[this.minimum()]) ? d = b = this.minimum() : this.op(b, "<", g[this.maximum()]) && (d = b = this.maximum())), d;
	  }, e.prototype.animate = function (b) {
	    var c = this.speed() > 0;this.is("animating") && this.onTransitionEnd(), c && (this.enter("animating"), this.trigger("translate")), a.support.transform3d && a.support.transition ? this.$stage.css({ transform: "translate3d(" + b + "px,0px,0px)", transition: this.speed() / 1e3 + "s" }) : c ? this.$stage.animate({ left: b + "px" }, this.speed(), this.settings.fallbackEasing, a.proxy(this.onTransitionEnd, this)) : this.$stage.css({ left: b + "px" });
	  }, e.prototype.is = function (a) {
	    return this._states.current[a] && this._states.current[a] > 0;
	  }, e.prototype.current = function (a) {
	    if (a === d) return this._current;if (0 === this._items.length) return d;if (a = this.normalize(a), this._current !== a) {
	      var b = this.trigger("change", { property: { name: "position", value: a } });b.data !== d && (a = this.normalize(b.data)), this._current = a, this.invalidate("position"), this.trigger("changed", { property: { name: "position", value: this._current } });
	    }return this._current;
	  }, e.prototype.invalidate = function (b) {
	    return "string" === a.type(b) && (this._invalidated[b] = !0, this.is("valid") && this.leave("valid")), a.map(this._invalidated, function (a, b) {
	      return b;
	    });
	  }, e.prototype.reset = function (a) {
	    a = this.normalize(a), a !== d && (this._speed = 0, this._current = a, this.suppress(["translate", "translated"]), this.animate(this.coordinates(a)), this.release(["translate", "translated"]));
	  }, e.prototype.normalize = function (a, b) {
	    var c = this._items.length,
	        e = b ? 0 : this._clones.length;return !this.isNumeric(a) || c < 1 ? a = d : (a < 0 || a >= c + e) && (a = ((a - e / 2) % c + c) % c + e / 2), a;
	  }, e.prototype.relative = function (a) {
	    return a -= this._clones.length / 2, this.normalize(a, !0);
	  }, e.prototype.maximum = function (a) {
	    var b,
	        c,
	        d,
	        e = this.settings,
	        f = this._coordinates.length;if (e.loop) f = this._clones.length / 2 + this._items.length - 1;else if (e.autoWidth || e.merge) {
	      for (b = this._items.length, c = this._items[--b].width(), d = this.$element.width(); b-- && (c += this._items[b].width() + this.settings.margin, !(c > d));) {}f = b + 1;
	    } else f = e.center ? this._items.length - 1 : this._items.length - e.items;return a && (f -= this._clones.length / 2), Math.max(f, 0);
	  }, e.prototype.minimum = function (a) {
	    return a ? 0 : this._clones.length / 2;
	  }, e.prototype.items = function (a) {
	    return a === d ? this._items.slice() : (a = this.normalize(a, !0), this._items[a]);
	  }, e.prototype.mergers = function (a) {
	    return a === d ? this._mergers.slice() : (a = this.normalize(a, !0), this._mergers[a]);
	  }, e.prototype.clones = function (b) {
	    var c = this._clones.length / 2,
	        e = c + this._items.length,
	        f = function f(a) {
	      return a % 2 === 0 ? e + a / 2 : c - (a + 1) / 2;
	    };return b === d ? a.map(this._clones, function (a, b) {
	      return f(b);
	    }) : a.map(this._clones, function (a, c) {
	      return a === b ? f(c) : null;
	    });
	  }, e.prototype.speed = function (a) {
	    return a !== d && (this._speed = a), this._speed;
	  }, e.prototype.coordinates = function (b) {
	    var c,
	        e = 1,
	        f = b - 1;return b === d ? a.map(this._coordinates, a.proxy(function (a, b) {
	      return this.coordinates(b);
	    }, this)) : (this.settings.center ? (this.settings.rtl && (e = -1, f = b + 1), c = this._coordinates[b], c += (this.width() - c + (this._coordinates[f] || 0)) / 2 * e) : c = this._coordinates[f] || 0, c = Math.ceil(c));
	  }, e.prototype.duration = function (a, b, c) {
	    return 0 === c ? 0 : Math.min(Math.max(Math.abs(b - a), 1), 6) * Math.abs(c || this.settings.smartSpeed);
	  }, e.prototype.to = function (a, b) {
	    var c = this.current(),
	        d = null,
	        e = a - this.relative(c),
	        f = (e > 0) - (e < 0),
	        g = this._items.length,
	        h = this.minimum(),
	        i = this.maximum();this.settings.loop ? (!this.settings.rewind && Math.abs(e) > g / 2 && (e += f * -1 * g), a = c + e, d = ((a - h) % g + g) % g + h, d !== a && d - e <= i && d - e > 0 && (c = d - e, a = d, this.reset(c))) : this.settings.rewind ? (i += 1, a = (a % i + i) % i) : a = Math.max(h, Math.min(i, a)), this.speed(this.duration(c, a, b)), this.current(a), this.$element.is(":visible") && this.update();
	  }, e.prototype.next = function (a) {
	    a = a || !1, this.to(this.relative(this.current()) + 1, a);
	  }, e.prototype.prev = function (a) {
	    a = a || !1, this.to(this.relative(this.current()) - 1, a);
	  }, e.prototype.onTransitionEnd = function (a) {
	    if (a !== d && (a.stopPropagation(), (a.target || a.srcElement || a.originalTarget) !== this.$stage.get(0))) return !1;this.leave("animating"), this.trigger("translated");
	  }, e.prototype.viewport = function () {
	    var d;return this.options.responsiveBaseElement !== b ? d = a(this.options.responsiveBaseElement).width() : b.innerWidth ? d = b.innerWidth : c.documentElement && c.documentElement.clientWidth ? d = c.documentElement.clientWidth : console.warn("Can not detect viewport width."), d;
	  }, e.prototype.replace = function (b) {
	    this.$stage.empty(), this._items = [], b && (b = b instanceof jQuery ? b : a(b)), this.settings.nestedItemSelector && (b = b.find("." + this.settings.nestedItemSelector)), b.filter(function () {
	      return 1 === this.nodeType;
	    }).each(a.proxy(function (a, b) {
	      b = this.prepare(b), this.$stage.append(b), this._items.push(b), this._mergers.push(1 * b.find("[data-merge]").addBack("[data-merge]").attr("data-merge") || 1);
	    }, this)), this.reset(this.isNumeric(this.settings.startPosition) ? this.settings.startPosition : 0), this.invalidate("items");
	  }, e.prototype.add = function (b, c) {
	    var e = this.relative(this._current);c = c === d ? this._items.length : this.normalize(c, !0), b = b instanceof jQuery ? b : a(b), this.trigger("add", { content: b, position: c }), b = this.prepare(b), 0 === this._items.length || c === this._items.length ? (0 === this._items.length && this.$stage.append(b), 0 !== this._items.length && this._items[c - 1].after(b), this._items.push(b), this._mergers.push(1 * b.find("[data-merge]").addBack("[data-merge]").attr("data-merge") || 1)) : (this._items[c].before(b), this._items.splice(c, 0, b), this._mergers.splice(c, 0, 1 * b.find("[data-merge]").addBack("[data-merge]").attr("data-merge") || 1)), this._items[e] && this.reset(this._items[e].index()), this.invalidate("items"), this.trigger("added", { content: b, position: c });
	  }, e.prototype.remove = function (a) {
	    a = this.normalize(a, !0), a !== d && (this.trigger("remove", { content: this._items[a], position: a }), this._items[a].remove(), this._items.splice(a, 1), this._mergers.splice(a, 1), this.invalidate("items"), this.trigger("removed", { content: null, position: a }));
	  }, e.prototype.preloadAutoWidthImages = function (b) {
	    b.each(a.proxy(function (b, c) {
	      this.enter("pre-loading"), c = a(c), a(new Image()).one("load", a.proxy(function (a) {
	        c.attr("src", a.target.src), c.css("opacity", 1), this.leave("pre-loading"), !this.is("pre-loading") && !this.is("initializing") && this.refresh();
	      }, this)).attr("src", c.attr("src") || c.attr("data-src") || c.attr("data-src-retina"));
	    }, this));
	  }, e.prototype.destroy = function () {
	    this.$element.off(".owl.core"), this.$stage.off(".owl.core"), a(c).off(".owl.core"), this.settings.responsive !== !1 && (b.clearTimeout(this.resizeTimer), this.off(b, "resize", this._handlers.onThrottledResize));for (var d in this._plugins) {
	      this._plugins[d].destroy();
	    }this.$stage.children(".cloned").remove(), this.$stage.unwrap(), this.$stage.children().contents().unwrap(), this.$stage.children().unwrap(), this.$element.removeClass(this.options.refreshClass).removeClass(this.options.loadingClass).removeClass(this.options.loadedClass).removeClass(this.options.rtlClass).removeClass(this.options.dragClass).removeClass(this.options.grabClass).attr("class", this.$element.attr("class").replace(new RegExp(this.options.responsiveClass + "-\\S+\\s", "g"), "")).removeData("owl.carousel");
	  }, e.prototype.op = function (a, b, c) {
	    var d = this.settings.rtl;switch (b) {case "<":
	        return d ? a > c : a < c;case ">":
	        return d ? a < c : a > c;case ">=":
	        return d ? a <= c : a >= c;case "<=":
	        return d ? a >= c : a <= c;}
	  }, e.prototype.on = function (a, b, c, d) {
	    a.addEventListener ? a.addEventListener(b, c, d) : a.attachEvent && a.attachEvent("on" + b, c);
	  }, e.prototype.off = function (a, b, c, d) {
	    a.removeEventListener ? a.removeEventListener(b, c, d) : a.detachEvent && a.detachEvent("on" + b, c);
	  }, e.prototype.trigger = function (b, c, d, f, g) {
	    var h = { item: { count: this._items.length, index: this.current() } },
	        i = a.camelCase(a.grep(["on", b, d], function (a) {
	      return a;
	    }).join("-").toLowerCase()),
	        j = a.Event([b, "owl", d || "carousel"].join(".").toLowerCase(), a.extend({ relatedTarget: this }, h, c));return this._supress[b] || (a.each(this._plugins, function (a, b) {
	      b.onTrigger && b.onTrigger(j);
	    }), this.register({ type: e.Type.Event, name: b }), this.$element.trigger(j), this.settings && "function" == typeof this.settings[i] && this.settings[i].call(this, j)), j;
	  }, e.prototype.enter = function (b) {
	    a.each([b].concat(this._states.tags[b] || []), a.proxy(function (a, b) {
	      this._states.current[b] === d && (this._states.current[b] = 0), this._states.current[b]++;
	    }, this));
	  }, e.prototype.leave = function (b) {
	    a.each([b].concat(this._states.tags[b] || []), a.proxy(function (a, b) {
	      this._states.current[b]--;
	    }, this));
	  }, e.prototype.register = function (b) {
	    if (b.type === e.Type.Event) {
	      if (a.event.special[b.name] || (a.event.special[b.name] = {}), !a.event.special[b.name].owl) {
	        var c = a.event.special[b.name]._default;a.event.special[b.name]._default = function (a) {
	          return !c || !c.apply || a.namespace && a.namespace.indexOf("owl") !== -1 ? a.namespace && a.namespace.indexOf("owl") > -1 : c.apply(this, arguments);
	        }, a.event.special[b.name].owl = !0;
	      }
	    } else b.type === e.Type.State && (this._states.tags[b.name] ? this._states.tags[b.name] = this._states.tags[b.name].concat(b.tags) : this._states.tags[b.name] = b.tags, this._states.tags[b.name] = a.grep(this._states.tags[b.name], a.proxy(function (c, d) {
	      return a.inArray(c, this._states.tags[b.name]) === d;
	    }, this)));
	  }, e.prototype.suppress = function (b) {
	    a.each(b, a.proxy(function (a, b) {
	      this._supress[b] = !0;
	    }, this));
	  }, e.prototype.release = function (b) {
	    a.each(b, a.proxy(function (a, b) {
	      delete this._supress[b];
	    }, this));
	  }, e.prototype.pointer = function (a) {
	    var c = { x: null, y: null };return a = a.originalEvent || a || b.event, a = a.touches && a.touches.length ? a.touches[0] : a.changedTouches && a.changedTouches.length ? a.changedTouches[0] : a, a.pageX ? (c.x = a.pageX, c.y = a.pageY) : (c.x = a.clientX, c.y = a.clientY), c;
	  }, e.prototype.isNumeric = function (a) {
	    return !isNaN(parseFloat(a));
	  }, e.prototype.difference = function (a, b) {
	    return { x: a.x - b.x, y: a.y - b.y };
	  }, a.fn.owlCarousel = function (b) {
	    var c = Array.prototype.slice.call(arguments, 1);return this.each(function () {
	      var d = a(this),
	          f = d.data("owl.carousel");f || (f = new e(this, "object" == (typeof b === "undefined" ? "undefined" : (0, _typeof3.default)(b)) && b), d.data("owl.carousel", f), a.each(["next", "prev", "to", "destroy", "refresh", "replace", "add", "remove"], function (b, c) {
	        f.register({ type: e.Type.Event, name: c }), f.$element.on(c + ".owl.carousel.core", a.proxy(function (a) {
	          a.namespace && a.relatedTarget !== this && (this.suppress([c]), f[c].apply(this, [].slice.call(arguments, 1)), this.release([c]));
	        }, f));
	      })), "string" == typeof b && "_" !== b.charAt(0) && f[b].apply(f, c);
	    });
	  }, a.fn.owlCarousel.Constructor = e;
	}(window.Zepto || window.jQuery, window, document), function (a, b, c, d) {
	  var e = function e(b) {
	    this._core = b, this._interval = null, this._visible = null, this._handlers = { "initialized.owl.carousel": a.proxy(function (a) {
	        a.namespace && this._core.settings.autoRefresh && this.watch();
	      }, this) }, this._core.options = a.extend({}, e.Defaults, this._core.options), this._core.$element.on(this._handlers);
	  };e.Defaults = { autoRefresh: !0, autoRefreshInterval: 500 }, e.prototype.watch = function () {
	    this._interval || (this._visible = this._core.$element.is(":visible"), this._interval = b.setInterval(a.proxy(this.refresh, this), this._core.settings.autoRefreshInterval));
	  }, e.prototype.refresh = function () {
	    this._core.$element.is(":visible") !== this._visible && (this._visible = !this._visible, this._core.$element.toggleClass("owl-hidden", !this._visible), this._visible && this._core.invalidate("width") && this._core.refresh());
	  }, e.prototype.destroy = function () {
	    var a, c;b.clearInterval(this._interval);for (a in this._handlers) {
	      this._core.$element.off(a, this._handlers[a]);
	    }for (c in (0, _getOwnPropertyNames2.default)(this)) {
	      "function" != typeof this[c] && (this[c] = null);
	    }
	  }, a.fn.owlCarousel.Constructor.Plugins.AutoRefresh = e;
	}(window.Zepto || window.jQuery, window, document), function (a, b, c, d) {
	  var e = function e(b) {
	    this._core = b, this._loaded = [], this._handlers = { "initialized.owl.carousel change.owl.carousel resized.owl.carousel": a.proxy(function (b) {
	        if (b.namespace && this._core.settings && this._core.settings.lazyLoad && (b.property && "position" == b.property.name || "initialized" == b.type)) for (var c = this._core.settings, e = c.center && Math.ceil(c.items / 2) || c.items, f = c.center && e * -1 || 0, g = (b.property && b.property.value !== d ? b.property.value : this._core.current()) + f, h = this._core.clones().length, i = a.proxy(function (a, b) {
	          this.load(b);
	        }, this); f++ < e;) {
	          this.load(h / 2 + this._core.relative(g)), h && a.each(this._core.clones(this._core.relative(g)), i), g++;
	        }
	      }, this) }, this._core.options = a.extend({}, e.Defaults, this._core.options), this._core.$element.on(this._handlers);
	  };e.Defaults = { lazyLoad: !1 }, e.prototype.load = function (c) {
	    var d = this._core.$stage.children().eq(c),
	        e = d && d.find(".owl-lazy");!e || a.inArray(d.get(0), this._loaded) > -1 || (e.each(a.proxy(function (c, d) {
	      var e,
	          f = a(d),
	          g = b.devicePixelRatio > 1 && f.attr("data-src-retina") || f.attr("data-src");this._core.trigger("load", { element: f, url: g }, "lazy"), f.is("img") ? f.one("load.owl.lazy", a.proxy(function () {
	        f.css("opacity", 1), this._core.trigger("loaded", { element: f, url: g }, "lazy");
	      }, this)).attr("src", g) : (e = new Image(), e.onload = a.proxy(function () {
	        f.css({ "background-image": 'url("' + g + '")', opacity: "1" }), this._core.trigger("loaded", { element: f, url: g }, "lazy");
	      }, this), e.src = g);
	    }, this)), this._loaded.push(d.get(0)));
	  }, e.prototype.destroy = function () {
	    var a, b;for (a in this.handlers) {
	      this._core.$element.off(a, this.handlers[a]);
	    }for (b in (0, _getOwnPropertyNames2.default)(this)) {
	      "function" != typeof this[b] && (this[b] = null);
	    }
	  }, a.fn.owlCarousel.Constructor.Plugins.Lazy = e;
	}(window.Zepto || window.jQuery, window, document), function (a, b, c, d) {
	  var e = function e(b) {
	    this._core = b, this._handlers = { "initialized.owl.carousel refreshed.owl.carousel": a.proxy(function (a) {
	        a.namespace && this._core.settings.autoHeight && this.update();
	      }, this), "changed.owl.carousel": a.proxy(function (a) {
	        a.namespace && this._core.settings.autoHeight && "position" == a.property.name && this.update();
	      }, this), "loaded.owl.lazy": a.proxy(function (a) {
	        a.namespace && this._core.settings.autoHeight && a.element.closest("." + this._core.settings.itemClass).index() === this._core.current() && this.update();
	      }, this) }, this._core.options = a.extend({}, e.Defaults, this._core.options), this._core.$element.on(this._handlers);
	  };e.Defaults = { autoHeight: !1, autoHeightClass: "owl-height" }, e.prototype.update = function () {
	    var b = this._core._current,
	        c = b + this._core.settings.items,
	        d = this._core.$stage.children().toArray().slice(b, c),
	        e = [],
	        f = 0;a.each(d, function (b, c) {
	      e.push(a(c).height());
	    }), f = Math.max.apply(null, e), this._core.$stage.parent().height(f).addClass(this._core.settings.autoHeightClass);
	  }, e.prototype.destroy = function () {
	    var a, b;for (a in this._handlers) {
	      this._core.$element.off(a, this._handlers[a]);
	    }for (b in (0, _getOwnPropertyNames2.default)(this)) {
	      "function" != typeof this[b] && (this[b] = null);
	    }
	  }, a.fn.owlCarousel.Constructor.Plugins.AutoHeight = e;
	}(window.Zepto || window.jQuery, window, document), function (a, b, c, d) {
	  var e = function e(b) {
	    this._core = b, this._videos = {}, this._playing = null, this._handlers = { "initialized.owl.carousel": a.proxy(function (a) {
	        a.namespace && this._core.register({ type: "state", name: "playing", tags: ["interacting"] });
	      }, this), "resize.owl.carousel": a.proxy(function (a) {
	        a.namespace && this._core.settings.video && this.isInFullScreen() && a.preventDefault();
	      }, this), "refreshed.owl.carousel": a.proxy(function (a) {
	        a.namespace && this._core.is("resizing") && this._core.$stage.find(".cloned .owl-video-frame").remove();
	      }, this), "changed.owl.carousel": a.proxy(function (a) {
	        a.namespace && "position" === a.property.name && this._playing && this.stop();
	      }, this), "prepared.owl.carousel": a.proxy(function (b) {
	        if (b.namespace) {
	          var c = a(b.content).find(".owl-video");c.length && (c.css("display", "none"), this.fetch(c, a(b.content)));
	        }
	      }, this) }, this._core.options = a.extend({}, e.Defaults, this._core.options), this._core.$element.on(this._handlers), this._core.$element.on("click.owl.video", ".owl-video-play-icon", a.proxy(function (a) {
	      this.play(a);
	    }, this));
	  };e.Defaults = { video: !1, videoHeight: !1, videoWidth: !1 }, e.prototype.fetch = function (a, b) {
	    var c = function () {
	      return a.attr("data-vimeo-id") ? "vimeo" : a.attr("data-vzaar-id") ? "vzaar" : "youtube";
	    }(),
	        d = a.attr("data-vimeo-id") || a.attr("data-youtube-id") || a.attr("data-vzaar-id"),
	        e = a.attr("data-width") || this._core.settings.videoWidth,
	        f = a.attr("data-height") || this._core.settings.videoHeight,
	        g = a.attr("href");if (!g) throw new Error("Missing video URL.");if (d = g.match(/(http:|https:|)\/\/(player.|www.|app.)?(vimeo\.com|youtu(be\.com|\.be|be\.googleapis\.com)|vzaar\.com)\/(video\/|videos\/|embed\/|channels\/.+\/|groups\/.+\/|watch\?v=|v\/)?([A-Za-z0-9._%-]*)(\&\S+)?/), d[3].indexOf("youtu") > -1) c = "youtube";else if (d[3].indexOf("vimeo") > -1) c = "vimeo";else {
	      if (!(d[3].indexOf("vzaar") > -1)) throw new Error("Video URL not supported.");c = "vzaar";
	    }d = d[6], this._videos[g] = { type: c, id: d, width: e, height: f }, b.attr("data-video", g), this.thumbnail(a, this._videos[g]);
	  }, e.prototype.thumbnail = function (b, c) {
	    var d,
	        e,
	        f,
	        g = c.width && c.height ? 'style="width:' + c.width + "px;height:" + c.height + 'px;"' : "",
	        h = b.find("img"),
	        i = "src",
	        j = "",
	        k = this._core.settings,
	        l = function l(a) {
	      e = '<div class="owl-video-play-icon"></div>', d = k.lazyLoad ? '<div class="owl-video-tn ' + j + '" ' + i + '="' + a + '"></div>' : '<div class="owl-video-tn" style="opacity:1;background-image:url(' + a + ')"></div>', b.after(d), b.after(e);
	    };if (b.wrap('<div class="owl-video-wrapper"' + g + "></div>"), this._core.settings.lazyLoad && (i = "data-src", j = "owl-lazy"), h.length) return l(h.attr(i)), h.remove(), !1;"youtube" === c.type ? (f = "//img.youtube.com/vi/" + c.id + "/hqdefault.jpg", l(f)) : "vimeo" === c.type ? a.ajax({ type: "GET", url: "//vimeo.com/api/v2/video/" + c.id + ".json", jsonp: "callback", dataType: "jsonp", success: function success(a) {
	        f = a[0].thumbnail_large, l(f);
	      } }) : "vzaar" === c.type && a.ajax({ type: "GET", url: "//vzaar.com/api/videos/" + c.id + ".json", jsonp: "callback", dataType: "jsonp", success: function success(a) {
	        f = a.framegrab_url, l(f);
	      } });
	  }, e.prototype.stop = function () {
	    this._core.trigger("stop", null, "video"), this._playing.find(".owl-video-frame").remove(), this._playing.removeClass("owl-video-playing"), this._playing = null, this._core.leave("playing"), this._core.trigger("stopped", null, "video");
	  }, e.prototype.play = function (b) {
	    var c,
	        d = a(b.target),
	        e = d.closest("." + this._core.settings.itemClass),
	        f = this._videos[e.attr("data-video")],
	        g = f.width || "100%",
	        h = f.height || this._core.$stage.height();this._playing || (this._core.enter("playing"), this._core.trigger("play", null, "video"), e = this._core.items(this._core.relative(e.index())), this._core.reset(e.index()), "youtube" === f.type ? c = '<iframe width="' + g + '" height="' + h + '" src="//www.youtube.com/embed/' + f.id + "?autoplay=1&rel=0&v=" + f.id + '" frameborder="0" allowfullscreen></iframe>' : "vimeo" === f.type ? c = '<iframe src="//player.vimeo.com/video/' + f.id + '?autoplay=1" width="' + g + '" height="' + h + '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>' : "vzaar" === f.type && (c = '<iframe frameborder="0"height="' + h + '"width="' + g + '" allowfullscreen mozallowfullscreen webkitAllowFullScreen src="//view.vzaar.com/' + f.id + '/player?autoplay=true"></iframe>'), a('<div class="owl-video-frame">' + c + "</div>").insertAfter(e.find(".owl-video")), this._playing = e.addClass("owl-video-playing"));
	  }, e.prototype.isInFullScreen = function () {
	    var b = c.fullscreenElement || c.mozFullScreenElement || c.webkitFullscreenElement;return b && a(b).parent().hasClass("owl-video-frame");
	  }, e.prototype.destroy = function () {
	    var a, b;this._core.$element.off("click.owl.video");for (a in this._handlers) {
	      this._core.$element.off(a, this._handlers[a]);
	    }for (b in (0, _getOwnPropertyNames2.default)(this)) {
	      "function" != typeof this[b] && (this[b] = null);
	    }
	  }, a.fn.owlCarousel.Constructor.Plugins.Video = e;
	}(window.Zepto || window.jQuery, window, document), function (a, b, c, d) {
	  var e = function e(b) {
	    this.core = b, this.core.options = a.extend({}, e.Defaults, this.core.options), this.swapping = !0, this.previous = d, this.next = d, this.handlers = { "change.owl.carousel": a.proxy(function (a) {
	        a.namespace && "position" == a.property.name && (this.previous = this.core.current(), this.next = a.property.value);
	      }, this), "drag.owl.carousel dragged.owl.carousel translated.owl.carousel": a.proxy(function (a) {
	        a.namespace && (this.swapping = "translated" == a.type);
	      }, this), "translate.owl.carousel": a.proxy(function (a) {
	        a.namespace && this.swapping && (this.core.options.animateOut || this.core.options.animateIn) && this.swap();
	      }, this) }, this.core.$element.on(this.handlers);
	  };e.Defaults = { animateOut: !1, animateIn: !1 }, e.prototype.swap = function () {
	    if (1 === this.core.settings.items && a.support.animation && a.support.transition) {
	      this.core.speed(0);var b,
	          c = a.proxy(this.clear, this),
	          d = this.core.$stage.children().eq(this.previous),
	          e = this.core.$stage.children().eq(this.next),
	          f = this.core.settings.animateIn,
	          g = this.core.settings.animateOut;this.core.current() !== this.previous && (g && (b = this.core.coordinates(this.previous) - this.core.coordinates(this.next), d.one(a.support.animation.end, c).css({ left: b + "px" }).addClass("animated owl-animated-out").addClass(g)), f && e.one(a.support.animation.end, c).addClass("animated owl-animated-in").addClass(f));
	    }
	  }, e.prototype.clear = function (b) {
	    a(b.target).css({ left: "" }).removeClass("animated owl-animated-out owl-animated-in").removeClass(this.core.settings.animateIn).removeClass(this.core.settings.animateOut), this.core.onTransitionEnd();
	  }, e.prototype.destroy = function () {
	    var a, b;for (a in this.handlers) {
	      this.core.$element.off(a, this.handlers[a]);
	    }for (b in (0, _getOwnPropertyNames2.default)(this)) {
	      "function" != typeof this[b] && (this[b] = null);
	    }
	  }, a.fn.owlCarousel.Constructor.Plugins.Animate = e;
	}(window.Zepto || window.jQuery, window, document), function (a, b, c, d) {
	  var e = function e(b) {
	    this._core = b, this._timeout = null, this._paused = !1, this._handlers = { "changed.owl.carousel": a.proxy(function (a) {
	        a.namespace && "settings" === a.property.name ? this._core.settings.autoplay ? this.play() : this.stop() : a.namespace && "position" === a.property.name && this._core.settings.autoplay && this._setAutoPlayInterval();
	      }, this), "initialized.owl.carousel": a.proxy(function (a) {
	        a.namespace && this._core.settings.autoplay && this.play();
	      }, this), "play.owl.autoplay": a.proxy(function (a, b, c) {
	        a.namespace && this.play(b, c);
	      }, this), "stop.owl.autoplay": a.proxy(function (a) {
	        a.namespace && this.stop();
	      }, this), "mouseover.owl.autoplay": a.proxy(function () {
	        this._core.settings.autoplayHoverPause && this._core.is("rotating") && this.pause();
	      }, this), "mouseleave.owl.autoplay": a.proxy(function () {
	        this._core.settings.autoplayHoverPause && this._core.is("rotating") && this.play();
	      }, this), "touchstart.owl.core": a.proxy(function () {
	        this._core.settings.autoplayHoverPause && this._core.is("rotating") && this.pause();
	      }, this), "touchend.owl.core": a.proxy(function () {
	        this._core.settings.autoplayHoverPause && this.play();
	      }, this) }, this._core.$element.on(this._handlers), this._core.options = a.extend({}, e.Defaults, this._core.options);
	  };e.Defaults = { autoplay: !1, autoplayTimeout: 5e3, autoplayHoverPause: !1, autoplaySpeed: !1 }, e.prototype.play = function (a, b) {
	    this._paused = !1, this._core.is("rotating") || (this._core.enter("rotating"), this._setAutoPlayInterval());
	  }, e.prototype._getNextTimeout = function (d, e) {
	    return this._timeout && b.clearTimeout(this._timeout), b.setTimeout(a.proxy(function () {
	      this._paused || this._core.is("busy") || this._core.is("interacting") || c.hidden || this._core.next(e || this._core.settings.autoplaySpeed);
	    }, this), d || this._core.settings.autoplayTimeout);
	  }, e.prototype._setAutoPlayInterval = function () {
	    this._timeout = this._getNextTimeout();
	  }, e.prototype.stop = function () {
	    this._core.is("rotating") && (b.clearTimeout(this._timeout), this._core.leave("rotating"));
	  }, e.prototype.pause = function () {
	    this._core.is("rotating") && (this._paused = !0);
	  }, e.prototype.destroy = function () {
	    var a, b;this.stop();for (a in this._handlers) {
	      this._core.$element.off(a, this._handlers[a]);
	    }for (b in (0, _getOwnPropertyNames2.default)(this)) {
	      "function" != typeof this[b] && (this[b] = null);
	    }
	  }, a.fn.owlCarousel.Constructor.Plugins.autoplay = e;
	}(window.Zepto || window.jQuery, window, document), function (a, b, c, d) {
	  "use strict";
	  var e = function e(b) {
	    this._core = b, this._initialized = !1, this._pages = [], this._controls = {}, this._templates = [], this.$element = this._core.$element, this._overrides = { next: this._core.next, prev: this._core.prev, to: this._core.to }, this._handlers = { "prepared.owl.carousel": a.proxy(function (b) {
	        b.namespace && this._core.settings.dotsData && this._templates.push('<div class="' + this._core.settings.dotClass + '">' + a(b.content).find("[data-dot]").addBack("[data-dot]").attr("data-dot") + "</div>");
	      }, this), "added.owl.carousel": a.proxy(function (a) {
	        a.namespace && this._core.settings.dotsData && this._templates.splice(a.position, 0, this._templates.pop());
	      }, this), "remove.owl.carousel": a.proxy(function (a) {
	        a.namespace && this._core.settings.dotsData && this._templates.splice(a.position, 1);
	      }, this), "changed.owl.carousel": a.proxy(function (a) {
	        a.namespace && "position" == a.property.name && this.draw();
	      }, this), "initialized.owl.carousel": a.proxy(function (a) {
	        a.namespace && !this._initialized && (this._core.trigger("initialize", null, "navigation"), this.initialize(), this.update(), this.draw(), this._initialized = !0, this._core.trigger("initialized", null, "navigation"));
	      }, this), "refreshed.owl.carousel": a.proxy(function (a) {
	        a.namespace && this._initialized && (this._core.trigger("refresh", null, "navigation"), this.update(), this.draw(), this._core.trigger("refreshed", null, "navigation"));
	      }, this) }, this._core.options = a.extend({}, e.Defaults, this._core.options), this.$element.on(this._handlers);
	  };e.Defaults = { nav: !1, navText: ["prev", "next"], navSpeed: !1, navElement: "div", navContainer: !1, navContainerClass: "owl-nav", navClass: ["owl-prev", "owl-next"], slideBy: 1, dotClass: "owl-dot", dotsClass: "owl-dots", dots: !0, dotsEach: !1, dotsData: !1, dotsSpeed: !1, dotsContainer: !1 }, e.prototype.initialize = function () {
	    var b,
	        c = this._core.settings;this._controls.$relative = (c.navContainer ? a(c.navContainer) : a("<div>").addClass(c.navContainerClass).appendTo(this.$element)).addClass("disabled"), this._controls.$previous = a("<" + c.navElement + ">").addClass(c.navClass[0]).html(c.navText[0]).prependTo(this._controls.$relative).on("click", a.proxy(function (a) {
	      this.prev(c.navSpeed);
	    }, this)), this._controls.$next = a("<" + c.navElement + ">").addClass(c.navClass[1]).html(c.navText[1]).appendTo(this._controls.$relative).on("click", a.proxy(function (a) {
	      this.next(c.navSpeed);
	    }, this)), c.dotsData || (this._templates = [a("<div>").addClass(c.dotClass).append(a("<span>")).prop("outerHTML")]), this._controls.$absolute = (c.dotsContainer ? a(c.dotsContainer) : a("<div>").addClass(c.dotsClass).appendTo(this.$element)).addClass("disabled"), this._controls.$absolute.on("click", "div", a.proxy(function (b) {
	      var d = a(b.target).parent().is(this._controls.$absolute) ? a(b.target).index() : a(b.target).parent().index();b.preventDefault(), this.to(d, c.dotsSpeed);
	    }, this));for (b in this._overrides) {
	      this._core[b] = a.proxy(this[b], this);
	    }
	  }, e.prototype.destroy = function () {
	    var a, b, c, d;for (a in this._handlers) {
	      this.$element.off(a, this._handlers[a]);
	    }for (b in this._controls) {
	      this._controls[b].remove();
	    }for (d in this.overides) {
	      this._core[d] = this._overrides[d];
	    }for (c in (0, _getOwnPropertyNames2.default)(this)) {
	      "function" != typeof this[c] && (this[c] = null);
	    }
	  }, e.prototype.update = function () {
	    var a,
	        b,
	        c,
	        d = this._core.clones().length / 2,
	        e = d + this._core.items().length,
	        f = this._core.maximum(!0),
	        g = this._core.settings,
	        h = g.center || g.autoWidth || g.dotsData ? 1 : g.dotsEach || g.items;if ("page" !== g.slideBy && (g.slideBy = Math.min(g.slideBy, g.items)), g.dots || "page" == g.slideBy) for (this._pages = [], a = d, b = 0, c = 0; a < e; a++) {
	      if (b >= h || 0 === b) {
	        if (this._pages.push({ start: Math.min(f, a - d), end: a - d + h - 1 }), Math.min(f, a - d) === f) break;b = 0, ++c;
	      }b += this._core.mergers(this._core.relative(a));
	    }
	  }, e.prototype.draw = function () {
	    var b,
	        c = this._core.settings,
	        d = this._core.items().length <= c.items,
	        e = this._core.relative(this._core.current()),
	        f = c.loop || c.rewind;this._controls.$relative.toggleClass("disabled", !c.nav || d), c.nav && (this._controls.$previous.toggleClass("disabled", !f && e <= this._core.minimum(!0)), this._controls.$next.toggleClass("disabled", !f && e >= this._core.maximum(!0))), this._controls.$absolute.toggleClass("disabled", !c.dots || d), c.dots && (b = this._pages.length - this._controls.$absolute.children().length, c.dotsData && 0 !== b ? this._controls.$absolute.html(this._templates.join("")) : b > 0 ? this._controls.$absolute.append(new Array(b + 1).join(this._templates[0])) : b < 0 && this._controls.$absolute.children().slice(b).remove(), this._controls.$absolute.find(".active").removeClass("active"), this._controls.$absolute.children().eq(a.inArray(this.current(), this._pages)).addClass("active"));
	  }, e.prototype.onTrigger = function (b) {
	    var c = this._core.settings;b.page = { index: a.inArray(this.current(), this._pages), count: this._pages.length, size: c && (c.center || c.autoWidth || c.dotsData ? 1 : c.dotsEach || c.items) };
	  }, e.prototype.current = function () {
	    var b = this._core.relative(this._core.current());return a.grep(this._pages, a.proxy(function (a, c) {
	      return a.start <= b && a.end >= b;
	    }, this)).pop();
	  }, e.prototype.getPosition = function (b) {
	    var c,
	        d,
	        e = this._core.settings;return "page" == e.slideBy ? (c = a.inArray(this.current(), this._pages), d = this._pages.length, b ? ++c : --c, c = this._pages[(c % d + d) % d].start) : (c = this._core.relative(this._core.current()), d = this._core.items().length, b ? c += e.slideBy : c -= e.slideBy), c;
	  }, e.prototype.next = function (b) {
	    a.proxy(this._overrides.to, this._core)(this.getPosition(!0), b);
	  }, e.prototype.prev = function (b) {
	    a.proxy(this._overrides.to, this._core)(this.getPosition(!1), b);
	  }, e.prototype.to = function (b, c, d) {
	    var e;!d && this._pages.length ? (e = this._pages.length, a.proxy(this._overrides.to, this._core)(this._pages[(b % e + e) % e].start, c)) : a.proxy(this._overrides.to, this._core)(b, c);
	  }, a.fn.owlCarousel.Constructor.Plugins.Navigation = e;
	}(window.Zepto || window.jQuery, window, document), function (a, b, c, d) {
	  "use strict";
	  var e = function e(c) {
	    this._core = c, this._hashes = {}, this.$element = this._core.$element, this._handlers = { "initialized.owl.carousel": a.proxy(function (c) {
	        c.namespace && "URLHash" === this._core.settings.startPosition && a(b).trigger("hashchange.owl.navigation");
	      }, this), "prepared.owl.carousel": a.proxy(function (b) {
	        if (b.namespace) {
	          var c = a(b.content).find("[data-hash]").addBack("[data-hash]").attr("data-hash");if (!c) return;this._hashes[c] = b.content;
	        }
	      }, this), "changed.owl.carousel": a.proxy(function (c) {
	        if (c.namespace && "position" === c.property.name) {
	          var d = this._core.items(this._core.relative(this._core.current())),
	              e = a.map(this._hashes, function (a, b) {
	            return a === d ? b : null;
	          }).join();if (!e || b.location.hash.slice(1) === e) return;b.location.hash = e;
	        }
	      }, this) }, this._core.options = a.extend({}, e.Defaults, this._core.options), this.$element.on(this._handlers), a(b).on("hashchange.owl.navigation", a.proxy(function (a) {
	      var c = b.location.hash.substring(1),
	          e = this._core.$stage.children(),
	          f = this._hashes[c] && e.index(this._hashes[c]);f !== d && f !== this._core.current() && this._core.to(this._core.relative(f), !1, !0);
	    }, this));
	  };e.Defaults = { URLhashListener: !1 }, e.prototype.destroy = function () {
	    var c, d;a(b).off("hashchange.owl.navigation");for (c in this._handlers) {
	      this._core.$element.off(c, this._handlers[c]);
	    }for (d in (0, _getOwnPropertyNames2.default)(this)) {
	      "function" != typeof this[d] && (this[d] = null);
	    }
	  }, a.fn.owlCarousel.Constructor.Plugins.Hash = e;
	}(window.Zepto || window.jQuery, window, document), function (a, b, c, d) {
	  function e(b, c) {
	    var e = !1,
	        f = b.charAt(0).toUpperCase() + b.slice(1);return a.each((b + " " + h.join(f + " ") + f).split(" "), function (a, b) {
	      if (g[b] !== d) return e = !c || b, !1;
	    }), e;
	  }function f(a) {
	    return e(a, !0);
	  }var g = a("<support>").get(0).style,
	      h = "Webkit Moz O ms".split(" "),
	      i = { transition: { end: { WebkitTransition: "webkitTransitionEnd", MozTransition: "transitionend", OTransition: "oTransitionEnd", transition: "transitionend" } }, animation: { end: { WebkitAnimation: "webkitAnimationEnd", MozAnimation: "animationend", OAnimation: "oAnimationEnd", animation: "animationend" } } },
	      j = { csstransforms: function csstransforms() {
	      return !!e("transform");
	    }, csstransforms3d: function csstransforms3d() {
	      return !!e("perspective");
	    }, csstransitions: function csstransitions() {
	      return !!e("transition");
	    }, cssanimations: function cssanimations() {
	      return !!e("animation");
	    } };j.csstransitions() && (a.support.transition = new String(f("transition")), a.support.transition.end = i.transition.end[a.support.transition]), j.cssanimations() && (a.support.animation = new String(f("animation")), a.support.animation.end = i.animation.end[a.support.animation]), j.csstransforms() && (a.support.transform = new String(f("transform")), a.support.transform3d = j.csstransforms3d());
	}(window.Zepto || window.jQuery, window, document);

/***/ },
/* 103 */
/***/ function(module, exports, __webpack_require__) {

	module.exports = { "default": __webpack_require__(104), __esModule: true };

/***/ },
/* 104 */
/***/ function(module, exports, __webpack_require__) {

	__webpack_require__(105);
	var $Object = __webpack_require__(14).Object;
	module.exports = function getOwnPropertyNames(it){
	  return $Object.getOwnPropertyNames(it);
	};

/***/ },
/* 105 */
/***/ function(module, exports, __webpack_require__) {

	// 19.1.2.7 Object.getOwnPropertyNames(O)
	__webpack_require__(92)('getOwnPropertyNames', function(){
	  return __webpack_require__(65).f;
	});

/***/ },
/* 106 */
/***/ function(module, exports, __webpack_require__) {

	'use strict';
	
	Object.defineProperty(exports, "__esModule", {
	    value: true
	});
	exports.Component = undefined;
	
	var _classCallCheck2 = __webpack_require__(79);
	
	var _classCallCheck3 = _interopRequireDefault(_classCallCheck2);
	
	var _createClass2 = __webpack_require__(80);
	
	var _createClass3 = _interopRequireDefault(_createClass2);
	
	function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }
	
	/**
	 * Will set params:
	 * this.element{node}
	 * this.errors{bool}  error on define this.element
	 */
	
	var Component = exports.Component = function () {
	    function Component(el) {
	        (0, _classCallCheck3.default)(this, Component);
	
	        this.errors = false;
	        this.init = el;
	    }
	
	    /**
	     * Set this.element, before check for correctness.
	     *
	     * @param el{string} - class of init element.
	     */
	
	
	    (0, _createClass3.default)(Component, [{
	        key: 'checkOnExistElement',
	
	
	        /**
	         * Check is element exist.
	         * Check is element has ('.' or '#').
	         *
	         * @param el{string} - element.
	         * @returns {*} - element.
	         */
	        value: function checkOnExistElement(el) {
	            var elementClass = $(el);
	            if (!el) {
	                this.errors = true;
	                console.error('Error in Component: \'' + el + '\' has error with init');
	                return false;
	            }
	            if (!elementClass.length) {
	                if (el.indexOf('.') != 0 && el.indexOf('#') != 0) {
	                    this.errors = true;
	                    console.error('Error in Component: \'' + el + '\' does not contain the identification \'.\' or \'#\'');
	                    return false;
	                }
	                this.errors = true;
	                console.warn('Warning in Component: \'' + el + '\' is not define on page');
	                return false;
	            }
	            return elementClass;
	        }
	    }, {
	        key: 'init',
	        set: function set(el) {
	            var elementClass = this.checkOnExistElement(el);
	            if (elementClass) {
	                this.element = elementClass;
	                this.errors = false;
	                return;
	            }
	            this.errors = true;
	        }
	
	        /**
	         * Getter for element.
	         *
	         * @returns {node} - element of slider init.
	         */
	
	    }, {
	        key: 'getElement',
	        get: function get() {
	            return this.element;
	        }
	    }]);
	    return Component;
	}();

/***/ },
/* 107 */
/***/ function(module, exports) {

	'use strict';
	
	Object.defineProperty(exports, "__esModule", {
	    value: true
	});
	var ui = exports.ui = {
	    //POPUP GALLERY
	
	    /**
	     * function opens popup with an item when you click on it
	     *
	     * @param el - an element which we choose as a gallery item
	     */
	    galleryPopupInit: function galleryPopupInit(el) {
	        $(el).magnificPopup({
	            delegate: 'a', // the selector for gallery item
	            type: 'image',
	            tLoading: 'Загрузка изображения #%curr%...',
	            gallery: {
	                enabled: true,
	                navigateByImgClick: true
	            }
	        });
	    }
	};

/***/ }
/******/ ]);
//# sourceMappingURL=script.js.map