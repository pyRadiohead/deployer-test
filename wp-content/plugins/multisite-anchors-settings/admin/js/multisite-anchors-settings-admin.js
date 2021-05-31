/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
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
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./src/admin/js/admin.js":
/*!*******************************!*\
  !*** ./src/admin/js/admin.js ***!
  \*******************************/
/*! no static exports found */
/***/ (function(module, exports) {

document.addEventListener('click', function (e) {
  console.log(e.target.id !== 'mas-change-anchor-btn');
  if (e.target.id !== 'mas-change-anchor-btn' && e.target.id !== 'mas-delete-link-btn') return;
  e.preventDefault();
  console.log('we were here');
  var target = e.target;
  var blogId = target.dataset.blog_id;
  var postID = target.dataset.post_id;
  var formElement = target.parentElement;
  var currentAnchor = formElement.querySelector('#current-anchor').value;
  var newAnchor = formElement.querySelector('#new-anchor').value;
  var link = formElement.querySelector('#link').value;
  fetch(ajaxurl, {
    method: 'POST',
    credentials: 'same-origin',
    headers: new Headers({
      'Content-Type': 'application/x-www-form-urlencoded'
    }),
    body: new URLSearchParams({
      action: 'ajax_change_anchor',
      blog_id: blogId,
      post_id: postID,
      current_anchor: currentAnchor,
      new_anchor: newAnchor,
      link: link,
      referrer: target.id
    }) // body data type must match "Content-Type" header

  }).then(function (data) {
    return data.json();
  }).then(function (response) {
    console.log(response);
  })["catch"](function (err) {
    return console.log(err);
  })["finally"](function () {
    target.classList.add('btn-success');
    target.classList.remove('btn-primary');

    if (target.id === 'mas-change-anchor-btn') {
      target.innerText = 'Changed';
    } else {
      target.innerText = 'Deleted';
    }
  });
});
document.addEventListener('click', function (e) {
  if (e.target.id !== 'pattern-submit-btn') return;
  e.preventDefault();
  var target = e.target;
  var formElement = target.parentElement;
  var patternValue = formElement.querySelector('#inputPattern').value;
  myStorage = window.localStorage;
  myStorage.setItem('linkPattern', patternValue);
  window.location.search += '&link-pattern=' + patternValue;
});
window.addEventListener('load', function () {
  var savedInputPattern = window.localStorage.getItem('linkPattern');

  if (savedInputPattern) {
    document.querySelector('#inputPattern').value = savedInputPattern;
  }
});

/***/ }),

/***/ "./src/admin/scss/admin.scss":
/*!***********************************!*\
  !*** ./src/admin/scss/admin.scss ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ 0:
/*!*****************************************************************!*\
  !*** multi ./src/admin/js/admin.js ./src/admin/scss/admin.scss ***!
  \*****************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /home/yura/Local Sites/testmultisite/app/public/wp-content/plugins/multisite-anchors-settings/src/admin/js/admin.js */"./src/admin/js/admin.js");
module.exports = __webpack_require__(/*! /home/yura/Local Sites/testmultisite/app/public/wp-content/plugins/multisite-anchors-settings/src/admin/scss/admin.scss */"./src/admin/scss/admin.scss");


/***/ })

/******/ });