<?php
/*
 * Copyright (C) 2015 Zeeshan Abbas <zeeshan@iibsys.com> <+966 55 4137245>
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of   
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */
?>

<script>
    "use strict";

    console.log("system.caller.js init...");

    function _ajaxGetContent(_handler, _response, _qs) {

        let spinner = document.getElementById("spinner");
        let response_box = document.getElementById(_response);
        response_box.innerHTML = '';

        let http = new XMLHttpRequest();
        let httpPath = '<?php echo __AJAX_CALL_PATH__; ?>';

        let canHttp = (!http && typeof http !== 'undefined') ? true : false;

        if (canHttp) {
            console.log("Error in creating ajax request");
        } else {
            spinner.style.display = "block";
            http.addEventListener('load', function (e) {
                spinner.style.display = "none";
                let r = http.responseText;
                response_box.innerHTML = r;

                setTimeout(function () {
                    __global_inteface_init();
                }, 500);


            });

            let parameters = "&_path=" + _handler + _qs;
            http.open("POST", httpPath, true);
            http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            http.send(parameters);
        }
    }

    function _ajaxCallWithDataObject(dataObject) {
        let spinner = document.getElementById("spinner");
        let http = new XMLHttpRequest();
        let httpPath = '<?php echo __AJAX_CALL_PATH__; ?>';
        let canHttp = (!http && typeof http !== 'undefined') ? true : false;
        let __data = dataObject;
        if (canHttp) {
            console.log("Error in creating ajax request");
        } else {
            spinner.style.display = "block";
            http.addEventListener('load', function (e) {
                spinner.style.display = "none";
                let r = http.response;
                if (r) {
                    console.log(r);

                    if (r.status) {
                    }

                    if (r.reload) {
                        __reloadWithDelay();
                    }

                    if (r.reload_without_delay) {
                        __reloadWithoutDelay();
                    }

                    if (r.redirect) {
                        __callForRedirection(r.redirect_url, r.redirect_delay);
                    }

                    if (r.content.status) {

                        let content_box = document.getElementById(r.content.container);
                        content_box.innerHTML = r.content.content;
                    }

                    if (r.callback.status) {
                        for (let i = 0; i < r.callback.name.length; i++) {
                            __callback(r.callback.name[i], r);
                        }
                    }

                    setTimeout(function () {
                        __global_inteface_init();
                    }, 500);


                } else {
                    _ajaxResposeErrorPage(form, _path);
                }

            });

            http.responseType = 'json';
            http.open("POST", httpPath, true);
            http.send(__data);
        }
    }


    function _ajaxCallWithDataObjectMute(dataObject) {

        let http = new XMLHttpRequest();
        let httpPath = '<?php echo __AJAX_CALL_PATH__; ?>';
        let canHttp = (!http && typeof http !== 'undefined') ? true : false;
        let __data = dataObject;
        if (canHttp) {
            console.log("Error in creating ajax request");
        } else {

            http.addEventListener('load', function (e) {

                let r = http.response;
                if (r) {
                    console.log(r);

                    if (r.status) {
                    }

                    if (r.reload) {
                        __reloadWithDelay();
                    }

                    if (r.reload_without_delay) {
                        __reloadWithoutDelay();
                    }

                    if (r.redirect) {
                        __callForRedirection(r.redirect_url, r.redirect_delay);
                    }

                    if (r.content.status) {
                        let content_box = document.getElementById(r.content.container);
                        content_box.innerHTML = r.content.content;
                    }

                    if (r.callback.status) {
                        for (let i = 0; i < r.callback.name.length; i++) {
                            __callback(r.callback.name[i], r);
                        }
                    }

                    setTimeout(function () {
                        __global_inteface_init();
                    }, 500);

                } else {
                    _ajaxResposeErrorPage(dataObject, dataObject._path);
                }

            });

            http.responseType = 'json';
            http.open("POST", httpPath, true);
            http.send(__data);
        }
    }

    function _ajaxCall(form, _path) {
        let spinner = document.getElementById("spinner");
        let http = new XMLHttpRequest();
        let httpPath = '<?php echo __AJAX_CALL_PATH__; ?>';
        let canHttp = (!http && typeof http !== 'undefined') ? true : false;
        let __data = _prepareAjaxRequestData(form, _path);
        if (canHttp) {
            console.log("Error in creating ajax request");
        } else {
            spinner.style.display = "block";
            http.addEventListener('load', function (e) {
                spinner.style.display = "none";

                let r = http.response;
                if (r) {
                    console.log(r);

                    if (r.status) {
                    }

                    if (r.reload) {
                        __reloadWithDelay();
                    }

                    if (r.reload_without_delay) {
                        __reloadWithoutDelay();
                    }

                    if (r.redirect) {
                        __callForRedirection(r.redirect_url, r.redirect_delay);
                    }

                    if (r.content.status) {

                        let content_box = document.getElementById(r.content.container);
                        content_box.innerHTML = r.content.content;
                    }

                    if (r.callback.status) {
                        for (let i = 0; i < r.callback.name.length; i++) {
                            __callback(r.callback.name[i], r);
                        }
                    }

                    setTimeout(function () {
                        __global_inteface_init();
                    }, 500);

                } else {
                    _ajaxResposeErrorPage(form, _path);
                }

            });

            http.responseType = 'json';
            http.open("POST", httpPath, true);
            http.send(__data);
        }
    }

    function _ajaxCallWithDataObject(dataObject) {
        let spinner = document.getElementById("spinner");
        let http = new XMLHttpRequest();
        let httpPath = '<?php echo __AJAX_CALL_PATH__; ?>';
        let canHttp = (!http && typeof http !== 'undefined') ? true : false;
        let __data = dataObject;
        if (canHttp) {
            console.log("Error in creating ajax request");
        } else {
            spinner.style.display = "block";
            http.addEventListener('load', function (e) {
                spinner.style.display = "none";
                let r = http.response;
                if (r) {
                    console.log(r);

                    if (r.status) {
                    }

                    if (r.reload) {
                        __reloadWithDelay();
                    }

                    if (r.reload_without_delay) {
                        __reloadWithoutDelay();
                    }

                    if (r.redirect) {
                        __callForRedirection(r.redirect_url, r.redirect_delay);
                    }

                    if (r.content.status) {

                        let content_box = document.getElementById(r.content.container);
                        content_box.innerHTML = r.content.content;
                    }

                    if (r.callback.status) {
                        for (let i = 0; i < r.callback.name.length; i++) {
                            __callback(r.callback.name[i], r);
                        }
                    }


                    setTimeout(function () {
                        __global_inteface_init();
                    }, 500);

                } else {
                    cosole.log("Error in _ajaxCallWithDataObject(dataObject) : \n\n" + r);
                }

            });

            http.responseType = 'json';
            http.open("POST", httpPath, true);
            http.send(__data);
        }
    }

    function _muteAjaxCall(form, _path) {
        let http = new XMLHttpRequest();
        let httpPath = '<?php echo __AJAX_CALL_PATH__; ?>';
        let canHttp = (!http && typeof http !== 'undefined') ? true : false;
        let __data = _prepareAjaxRequestData(form, _path);
        if (canHttp) {
            console.log("Error in creating ajax request");
        } else {
            http.addEventListener('load', function (e) {
                let r = http.response;
                if (r) {
                    console.log(r);

                    if (r.status) {
                    }

                    if (r.reload) {
                        __reloadWithDelay();
                    }

                    if (r.reload_without_delay) {
                        __reloadWithoutDelay();
                    }

                    if (r.redirect) {
                        __callForRedirection(r.redirect_url, r.redirect_delay);
                    }

                    if (r.content.status) {
                        let content_box = document.getElementById(r.content.container);
                        content_box.innerHTML = r.content.content;
                    }

                    if (r.callback.status) {
                        for (let i = 0; i < r.callback.name.length; i++) {
                            __callback(r.callback.name[i], r);
                        }
                    }

                    setTimeout(function () {
                        __global_inteface_init();
                    }, 500);
                } else {
                    _ajaxResposeErrorPage(form, _path);
                }

            });

            http.responseType = 'json';
            http.open("POST", httpPath, true);
            http.send(__data);
        }
    }

    function _ajaxResposeErrorPage(form, _path) {
        let http = new XMLHttpRequest();
        let httpPath = '<?php echo __AJAX_CALL_PATH__; ?>';
        let canHttp = (!http && typeof http !== 'undefined') ? true : false;
        let __data = _prepareAjaxRequestData(form, _path);
        if (canHttp) {
            console.log("Error in creating ajax request");
        } else {
            http.addEventListener('load', function (e) {
                document.getElementById('_php_error_response').innerHTML = http.responseText;
            });
            http.responseType = 'text';
            http.open("POST", httpPath, true);
            http.send(__data);
        }
    }

    function _prepareAjaxRequestData(form, _path) {
        let _d = new FormData();
        _d.append('_path', _path);
        let _e = document.getElementById(form);
        if (_e) {
            _e = _e.elements;
            for (let i = 0, element; element = _e[i++]; ) {
                if (element.type === 'file') {
                    let _f = document.querySelector('#' + element.id).files;
                    if (_f.length === 1) {
                        _d.append(element.name, _f[0]);
                    } else if (_f.length > 1) {
                        for (let f = 0; f < _f.length; f++) {
                            _d.append(element.name, _f[f]);
                        }
                    }
                } else if (element.type === 'radio') {
                    _d.append(element.name, _getRadioCheck(element));

                } else if (element.type === 'checkbox') {
                    _d.append(element.name, _getRadioCheck(element));
                } else {
                    _d.append(element.name, element.value);
                }
            }
        }

        return _d;
    }

    function __callback(cb_function, r) {
        if (typeof window[cb_function] === "function") {
            window[cb_function](r);
        } else {
            console.error(cb_function + ' function  is not defined....');
        }
    }

    function _getRadioCheck(el) {
        let ele = document.getElementsByName(el.name);
        for (let i = 0; i < ele.length; i++) {
            if (ele[i].checked) {
                return ele[i].value;
            }
        }
        return false;
    }

    function __reloadWithDelay() {
        setTimeout(function () {
            location.reload();
        }, 1000);
    }

    function __reloadWithoutDelay() {
        location.reload();
        return true;
    }

    function __callForRedirection(redirectToUrl, redirectDelay = 0) {
        setTimeout(function () {
            window.location = redirectToUrl;
            return true;
        }, redirectDelay);
    }


    function __global_inteface_init() {
        $('.selectpicker_picker').select2({
            theme: "bootstrap4"
        });


        $('.bootstrapToggleInit').bootstrapToggle();

        $('._generic_data_table').DataTable();
    }



    //_ajaxCall('__a', 'test/check_call');
    //_ajaxCall('', 'test/check_post');

</script>