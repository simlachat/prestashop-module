/**
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
*/
$(function(){
    function SimlachatUploadForm() {
        this.form = $('input[value="simlachat_upload_form"]').parent().get(0);

        if (typeof this.form === 'undefined') {
            return false;
        }

        this.input = $(this.form).find('input[name="SIMLACHAT_UPLOAD_CUSTOMERS_ID"]').get(0);
        this.submitButton = $(this.form).find('button[type="submit"]').get(0);
        this.messageContainer = document.querySelector('#content > div.bootstrap + div.bootstrap');
        this.submitAction = this.submitAction.bind(this);
        this.partitionId = this.partitionId.bind(this);
        this.setLoading = this.setLoading.bind(this);

        $(this.submitButton).click(this.submitAction);
    }

    SimlachatUploadForm.prototype.submitAction = function (event) {
        event.preventDefault();
        let ids = this.partitionId($(this.input).val().toString().replace(/\s+/g, ''));

        if (ids.length === 0) {
            return false;
        }

        this.setLoading(true);
        $(this.form).submit();
    };

    SimlachatUploadForm.prototype.setLoading = function (loading) {
        let indicator = $('div#simlachat-loading-fade');

        if (indicator.length === 0) {
            $('body').append(`
            <div id="simlachat-loading-fade">
                <div id="simlachat-loader"></div>
            </div>
            `.trim());
        }

        indicator.css('visibility', (loading ? 'visible' : 'hidden'));
    };

    SimlachatUploadForm.prototype.partitionId = function (idList) {
        if (idList === '') {
            return [];
        }

        let itemsList = idList.split(',');
        let ids = itemsList.filter(item => item.toString().indexOf('-') === -1);
        let ranges = itemsList.filter(item => item.toString().indexOf('-') !== -1);
        let resultRanges = [];

        ranges.forEach(item => {
            let rangeData = item.split('-');

            resultRanges = [...resultRanges, ...[...Array(+rangeData[1] + 1)
                .keys()].slice(+rangeData[0], +rangeData[1] + 1)];
        });

        return [...ids, ...resultRanges].map(item => +item).sort((a, b) => a - b);
    };

    new SimlachatUploadForm();
});
