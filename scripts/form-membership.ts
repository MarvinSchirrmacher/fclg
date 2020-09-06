import $ from 'jquery';
import { FormSummarizer } from './form';

function copyLastName() {
    var lastName = $(this).val();
    var fields = [
        '.quform-field-1_106',
        '.quform-field-1_118',
        '.quform-field-1_123',
        '.quform-field-1_128',
        '.quform-field-1_133'];
    fields.forEach(function (fieldClass) {
        $(fieldClass).val(lastName);
    });
}

$('.quform-field-1_7').focusout(copyLastName);
$('.quform-label-1_3.quform-options.quform-options-style-button')
    .addClass('columns gallery-columns-3');

var collector = new FormSummarizer('1', '1_7', '1_152');
collector.initialize();