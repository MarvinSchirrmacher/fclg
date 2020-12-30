import $ from 'jquery';

interface FormEntry {
    [key: string]: HTMLElement;
} 

interface FormPage {
    name: string;
    entries: FormEntry[]
}

export class FormSummarizer {
    private formId: string;
    private trigger: JQuery;
    private outputWrapper: HTMLElement;
    private pages: FormPage[];

    public constructor(formId: string, triggerPageId: string, outputWrapperId: string) {
        this.formId = `.quform-${formId}`;
        this.trigger = $(`${this.formId} .quform-page-${triggerPageId} .quform-next`);
        this.outputWrapper = $(`${this.formId} .quform-element-${outputWrapperId}`).get(0);
    }

    public initialize() {
        this.pages = this.collectFormPages();
        this.trigger.click(this.createOutputTable.bind(this));
    }

    private collectFormPages(): FormPage[] {
        let pageIdPattern = new RegExp('^quform-page-[\d]+$');
        let pageIds = $(`${this.formId} .quform-element-page`).toArray()
            .map(page => {
                let classes = page.className.split(' ');
                return classes.find(pageIdPattern.test)[0];
            });
        return pageIds.map(pageId => {
            return {
                name: $(`${pageId} .quform-page-title`).get(0).innerText,
                entries: $(`${pageId} .quform-input`).toArray().map(input => {
                    let id = input.getAttribute('id');
                    let label = $(`${pageId} label[for='${id}']`).get(0);
                    let key = label.innerText;
                    return { key: input };
                })
            }
        });
    }

    private createOutputTable() {
        let table = document.createElement('table');
        this.pages.forEach(page => {
            let head = document.createElement('thead');
            let row = head.insertRow();
            let cell = document.createElement('th');
            cell.setAttribute('colspan', '2');
            cell.innerText = page.name;
            row.appendChild(cell);

            let body = document.createElement('tbody');
            Object.keys(page.entries).forEach(key => {
                let row = body.insertRow();
                let keyCell = document.createElement('td');
                keyCell.innerText = key;
                let valueCell = document.createElement('td');
                valueCell.innerText = page.entries[key];
                row.appendChild(keyCell).appendChild(valueCell);
            });

            table.appendChild(head).appendChild(body);
        });
        this.outputWrapper.appendChild(table);
    }
}
// function styleForm() {
//     $('.quform-options.quform-options-style-button').addClass('columns gallery-columns-3');
// }

// function addConclusionTable() {
//     $('.quform-element-1_152 .quform-spacer').load(_directory + '/../../forms/membership-conclusion.html');
// }

// function copyLastName() {
//     var lastName = $(this).val();
//     var fields = [
//         '.quform-field-1_106',
//         '.quform-field-1_118',
//         '.quform-field-1_123',
//         '.quform-field-1_128',
//         '.quform-field-1_133'];
//     fields.forEach(function (fieldClass) {
//         $(fieldClass).val(lastName);
//     });
// }


// function fillInputConclusion() {
//     var conclusion = $('.quform-input-conclusion');

//     function fillFamilyMemberConclusion($rowId, $fieldIds) {
//         var prefix = '.quform-field_1_';
//         if (!$(prefix + $fieldIds[0]).val()) {
//             return;
//         }
//         conclusion.find($rowId).text(
//             $(prefix + $fieldIds[0]).val() + ' ' +
//             $(prefix + $fieldIds[1]).val() + ', ' +
//             $(prefix + $fieldIds[2]).val());
//     }

//     conclusion.find('#membership').text(
//         $('.quform-field-1_3')
//             .find('.quform-field-radio[name="quform_1_3"]:checked')
//             .val());
//     conclusion.find('#name').text(
//         $('.quform-field-1_6').val() + ' ' + $('.quform-field-1_7').val());
//     conclusion.find('#birthday').text($('.quform-field-1_11').val());
    
//     if ($('.quform-field-1_8').val()) {
//         conclusion.find('#address').text(
//             $('.quform-field-1_8').val() + ', ' +
//             $('.quform-field-1_10').val() + ' ' + $('.quform-field-1_9').val());
//     }
    
//     conclusion.find('#email-address').text($('.quform-field-1_12').val());
//     conclusion.find('#phone-number').text($('.quform-field-1_13').val());

//     if ($('.quform-field-1_19').val()) {
//         $('#eligibility-to-play').removeClass('hidden');
//     }

//     conclusion.find('#birthplace').text($('.quform-field-1_19').val());
//     conclusion.find('#nationality').text($('.quform-field-1_20').val());
//     conclusion.find('#gender').text($('.quform-field-1_21').val());
//     conclusion.find('#application-type').text($('.quform-field-1_25').val());

//     if ($('.quform-field-1_64').val()) {
//         $('#family').removeClass('hidden');
//     }

//     fillFamilyMemberConclusion('#family-member-1', new Array('64', '106', '65'));
//     fillFamilyMemberConclusion('#family-member-2', new Array('117', '118', '119'));
//     fillFamilyMemberConclusion('#family-member-3', new Array('122', '123', '124'));
//     fillFamilyMemberConclusion('#family-member-4', new Array('127', '128', '129'));
//     fillFamilyMemberConclusion('#family-member-5', new Array('132', '133', '134'));

//     if ($('.quform-field-1_56').val()) {
//         $('#collection-of-contributions').removeClass('hidden');
//     }

//     conclusion.find('#iban').text($('.quform-field-1_56').val());
//     conclusion.find('#bic').text($('.quform-field-1_57').val());
//     conclusion.find('#account-owner').text($('.quform-field-1_59').val());
// }