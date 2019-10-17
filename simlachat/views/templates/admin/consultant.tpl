{*
* MIT License
*
* Copyright (c) 2019 DIGITAL RETAIL TECHNOLOGIES SL
*
* Permission is hereby granted, free of charge, to any person obtaining a copy
* of this software and associated documentation files (the "Software"), to deal
* in the Software without restriction, including without limitation the rights
* to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
* copies of the Software, and to permit persons to whom the Software is
* furnished to do so, subject to the following conditions:
*
* The above copyright notice and this permission notice shall be included in
* all copies or substantial portions of the Software.
*
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
* SOFTWARE.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    DIGITAL RETAIL TECHNOLOGIES SL <mail@simlachat.com>
*  @copyright 2007-2019 DIGITAL RETAIL TECHNOLOGIES SL
*  @license   https://opensource.org/licenses/MIT  The MIT License
*
* Don't forget to prefix your containers with your own identifier
* to avoid any conflicts with others containers.
*}
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="{$assets|escape:'htmlall':'UTF-8'}/css/styles.min.css">
<title>SimlaChat</title>
<div class="simla simla-wrap">
    <div class="simla-container simla-column">
        <aside class="simla-column__aside">
            <div class="simla-menu">
                <a href="{$current|escape:'htmlall':'UTF-8'}&amp;token={$token|escape:'htmlall':'UTF-8'}&amp;configure=simlachat" class="simla-menu__btn simla-menu__btn_big">{l s='Configuration' mod='simlachat'}</a>
                <a href="{$current|escape:'htmlall':'UTF-8'}&amp;token={$token|escape:'htmlall':'UTF-8'}&amp;configure=simlachat&item=consultant" class="simla-menu__btn simla-menu__btn_active">{l s='Online consultant' mod='simlachat'}</a>
            </div>
        </aside>
        <article class="simla-column__content">
            <h1 class="simla-title simla-title_content">SimlaChat</h1>
            <div class="simla-form simla-form_main">
                <form action="{$current|escape:'htmlall':'UTF-8'}&amp;token={$token|escape:'htmlall':'UTF-8'}&amp;configure=simlachat&item=consultant" method="post">
                    <input type="hidden" name="submitsimlachat" value="1" />
                    <div class="simla-form__title">{l s='Online consultant' mod='simlachat'}</div>
                    <div class="simla-form__row">
                        <textarea required name="{$consultantScriptName|escape:'htmlall':'UTF-8'}" class="simla-form__area simla-form__area_txt" id="simla-txt-area" placeholder="{l s='Code you need to insert on the web' mod='simlachat'}">
                            {$consultantScript|escape:'htmlall':'UTF-8'}
                        </textarea>
                    </div>
                    <div class="simla-form__row simla-form__row_submit">
                        <input type="submit" value="{l s='Save' mod='simlachat'}" class="btn btn_invert btn_submit">
                    </div>
                </form>
            </div>
        </article>
    </div>
</div>
{*<script src="//ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>*}
{*<script>window.jQuery || document.write('<script src="./js/vendor/jquery-3.4.0.min.js"><\/script>')</script>*}
<script src="{$assets|escape:'htmlall':'UTF-8'}/js/scripts.js"></script>
