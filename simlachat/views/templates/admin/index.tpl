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
{$errors}
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="{$assets}/css/styles.min.css">
<title>SimlaChat</title>
<div class="simla simla-wrap">
    <div class="simla-container">
        <h1 class="simla-title">SimlaChat</h1>
        <div class="simla-txt simla-descript">
            {l s='Solution to convert more sales opportunities through web chat and Facebook Messenger, available 24/7, even when you\'re not online.' mod='simlachat'}
        </div>
        <div class="simla-video">
            <img src="{$assets}/img/video-bg.png" alt="" />
            <div class="simla-video__btn" data-popup="#video-popup">
                <svg width="101" height="101" viewBox="0 0 101 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M50.7188 0.46875C59.5897 0.46875 68.0575 2.8881 75.7188 7.32359C83.38 11.7591 89.4284 17.8075 93.8639 25.4688C98.2994 33.13 100.719 41.5978 100.719 50.4688C100.719 59.5413 98.2994 67.8075 93.8639 75.4688C89.4284 83.13 83.38 89.38 75.7188 93.8155C68.0575 98.251 59.5897 100.469 50.7188 100.469C41.6462 100.469 33.38 98.251 25.7188 93.8155C18.0575 89.38 11.8075 83.13 7.37198 75.4688C2.93649 67.8075 0.71875 59.5413 0.71875 50.4688C0.71875 41.5978 2.93649 33.13 7.37198 25.4688C11.8075 17.8075 18.0575 11.7591 25.7188 7.32359C33.38 2.8881 41.6462 0.46875 50.7188 0.46875ZM74.1059 55.3075C75.7188 54.501 76.5252 53.0897 76.5252 51.0736C76.5252 49.2591 75.7188 47.8478 74.1059 46.8397L38.622 25.2671C37.0091 24.4607 35.3962 24.4607 33.7833 25.2671C32.1704 26.2752 31.3639 27.6865 31.3639 29.501V71.4365C31.3639 73.4526 32.1704 74.8639 33.7833 75.6704C35.3962 76.6784 37.0091 76.6784 38.622 75.6704L74.1059 55.3075Z" fill="black"/>
                </svg>
            </div>
        </div>
        <div class="simla-btns">
            <a href="#toggle-form" class="btn btn_max toggle-btn">{l s='I have an account in SimlaChat' mod='simlachat'}</a>
            <div class="simla-btns__separate">or</div>
            <a href="https://simlachat.com/signup?utm_source=prestashop&utm_medium=modul&utm_campaign=button-in-modul" target="_black" class="btn btn_max btn_invert">{l s='Get SimlaChat for free' mod='simlachat'}</a>
        </div>
        <div class="simla-form toggle-box" id="toggle-form">
            <form action="{$current|escape:'htmlall':'UTF-8'}&amp;token={$token|escape:'htmlall':'UTF-8'}&amp;configure=simlachat" method="post">
                <input type="hidden" name="submitsimlachat" value="1" />
                <div class="simla-form__title">{l s='Connection Settings' mod='simlachat'}</div>
                <div class="simla-form__row">
                    <input required type="text" class="simla-form__area" placeholder="{l s='SimlaChat URL' mod='simlachat'}" name="{$apiUrl}">
                </div>
                <div class="simla-form__row">
                    <input required type="text" class="simla-form__area" placeholder="{l s='API key' mod='simlachat'}" name="{$apiKey}">
                </div>
                <div class="simla-form__row simla-form__row_submit">
                    <input type="submit" value="{l s='Save' mod='simlachat'}" class="btn btn_invert btn_submit">
                </div>
            </form>
        </div>
        <div class="simla-tabs">
            <div class="simla-tabs__head">
                <a href="#descript" class="simla-tabs__btn simla-tabs__btn_active">{l s='Description' mod='simlachat'}</a>
                <a href="#faq" class="simla-tabs__btn">FAQ</a>
                <a href="#contacts" class="simla-tabs__btn">{l s='Contacts' mod='simlachat'}</a>
            </div>
            <div class="simla-tabs__body">
                <div class="simla-tabs__item simla-tabs__item_active" id="descript" style="display: block;">
                    <p>
                        {l s='SimlaChat - Solution to capture new customers, create more sales opportunities and make precise monitoring until they become recurring customers through online chat and Facebook Messenger, available 24/7, even when you are not online.' mod='simlachat'}
                    </p>
                    <p>
                        {l s='SimlaChat functionalities:' mod='simlachat'}
                    </p>
                    <ul class="simla-list">
                        <li class="simla-list__item">{l s='Bot Distributor: Automatically assigns incoming messages between connected agents to simplify response time to the maximum.' mod='simlachat'}</li>
                        <li class="simla-list__item">{l s='Notes: within the client profile it is possible to leave comments about the client, so that in future interactions we have more information that will help us to finalize the sale.' mod='simlachat'}</li>
                        <li class="simla-list__item">{l s='Tasks: it helps to keep track of each client creating tasks and with the help of notifications you will not forget anything.' mod='simlachat'}</li>
                        <li class="simla-list__item">{l s='Communication history: you will always have at your disposal all the communication history with the client, regardless of the channel from which you have written.' mod='simlachat'}</li>
                        <li class="simla-list__item">{l s='Multi-agent: connect your entire team simultaneously to grow, reducing response time and improving the online reputation of your business.' mod='simlachat'}</li>
                        <li class="simla-list__item">{l s='Analytics: on the dynamics of messages received, information on the work of your managers and on the channels where the greatest amount of messages comes from, in order to invest in marketing campaigns on the correct channel.' mod='simlachat'}</li>
                    </ul>

                    <p>
                        {l s='SimlaChat is designed for all eCommerce companies that seek to open alternative paths for the development of their business through online chat, Facebook Messenger and other social networks.' mod='simlachat'}
                    </p>

                </div>
                <div class="simla-tabs__item" id="faq">
                    <div class="simla-tile">
                        <div class="simla-tile__col">
                            <div class="simla-tile__item">
                                <div class="simla-tile__title">{l s='Is there a trial of the module?' mod='simlachat'}</div>
                                <div class="simla-tile__descript">{l s='The module has a 14-day trial version in which you can work with the help of the SimlaChat module.' mod='simlachat'}</div>
                            </div>
                            <div class="simla-tile__item">
                                <div class="simla-tile__title">{l s='What is a user?' mod='simlachat'}</div>
                                <div class="simla-tile__descript">{l s='A user is the person who will work with the SimlaChat module as the representative of your business or your website. Each user can create a personal profile and have their own access to the tool panel.' mod='simlachat'}</div>
                            </div>
                            <div class="simla-tile__item">
                                <div class="simla-tile__title">{l s='In what languages is the module available?' mod='simlachat'}</div>
                                <div class="simla-tile__descript">{l s='The SimlaChat module is available in the following languages:' mod='simlachat'}
                                    <ul class="simla-list">
                                        <li class="simla-list__item">{l s='Spanish' mod='simlachat'}</li>
                                        <li class="simla-list__item">{l s='English' mod='simlachat'}</li>
                                        <li class="simla-list__item">{l s='Russian' mod='simlachat'}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="simla-tile__col">
                            <div class="simla-tile__item">
                                <div class="simla-tile__title">{l s='How long is the trial?' mod='simlachat'}</div>
                                <div class="simla-tile__descript">{l s='The duration of the trial version of the SimlaChat module is 14 days.' mod='simlachat'}</div>
                            </div>
                            <div class="simla-tile__item">
                                <div class="simla-tile__title">{l s='Is it paid per user or is it paid per account?' mod='simlachat'}</div>
                                <div class="simla-tile__descript">{l s='Payment is made per user, if another user is added to the SimlaChat system, payment by two users would be made. Each user has the right to an account (web-chat and social networks). In case a user needs to work with more than one account, it is necessary to contact the SimlaChat team.' mod='simlachat'}</div>
                            </div>
                            <div class="simla-tile__item">
                                <div class="simla-tile__title">{l s='How I can pay?' mod='simlachat'}</div>
                                <div class="simla-tile__descript">
                                    {l s='The methods to make the payment are:' mod='simlachat'}
                                    <ul class="simla-list">
                                        <li class="simla-list__item">{l s='Wire transfer' mod='simlachat'}</li>
                                        <li class="simla-list__item">{l s='Credit card' mod='simlachat'}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="simla-tabs__item" id="contacts">
                    <div class="simla-tile">
                        <div class="simla-tile__col">
                            <div class="simla-tile__item">
                                <div class="simla-tile__title">{l s='Our email and WhatsApp' mod='simlachat'}</div>
                                <div class="simla-tile__descript">{l s='Write us in case of questions or doubts' mod='simlachat'}</div>
                            </div>
                        </div>
                        <div class="simla-tile__col simla-tile__col_contacts">
                            <div class="simla-tile__item">
                                <div class="simla-tile__row">
                                    <a href="mailto:mail@simlachat.com" class="simla-tile__link">mail@simlachat.com</a>
                                </div>
                                <div class="simla-tile__row">
                                    <a href="https://wa.me/34722253423" target="_blank" class="btn btn_whatsapp">WhatsApp</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="simla-popup-wrap js-popup-close">
    <div class="simla-popup" id="video-popup">
        <div class="simla-popup__close js-popup-close"></div>
        <div id="player"></div>
    </div>
</div>
<script src="https://www.youtube.com/iframe_api"></script>
{*<script src="//ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>*}
{*<script>window.jQuery || document.write('<script src="{$assets}/js/vendor/jquery-3.4.0.min.js"><\/script>')</script>*}
<script src="{$assets}/js/scripts.js"></script>
