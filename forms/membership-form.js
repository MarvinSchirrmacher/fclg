
jQuery(document).ready(function ($) {
    $(".quform-element-1_3 .quform-options.quform-options-style-button")
        .addClass("columns gallery-columns-3");
    $(".quform-button-next-1_17 .quform-next").click(function() {
        const firstName = $(".quform-field-1_165_2").val();
        const lastName = $(".quform-field-1_165_4").val();
        const accountHolderField = $(".quform-field-1_59");
        accountHolderField.val(firstName + " " + lastName);
        const familyMemberNameFields = [
            ".quform-field-1_167_4",
            ".quform-field-1_168_4",
            ".quform-field-1_169_4",
            ".quform-field-1_170_4",
            ".quform-field-1_171_4",
            ".quform-field-1_173_4"];
        familyMemberNameFields.forEach(function (fieldClass) {
            $(fieldClass).val(lastName);
        });
    });
    
    var fees = {
        "Kind oder Jugendlicher": 56,
        "Geschwisterkind": 42,
        "Erwachsener": 90,
        "Rentner": 54,
        "Familie": 102
    };

    function determineFee(membership) {
        return membership in fees ? fees[membership] : 0;
    }

    $(".quform-button-next-1_17 .quform-next").click(function() {
        let description = $(".quform-element-1_58 .quform-group-description");
        let membership = $(".quform-input-1_3")
            .find(".quform-field-radio:checked")
            .val();

        const hasRegisteredFamilyMember = $(".quform-input-1_48")
            .find(".quform-field-radio:checked")
            .val() == "Ja";
        if (membership === "Kind oder Jugendlicher" && hasRegisteredFamilyMember) {
            membership = "Geschwisterkind";
        }
        const fee = determineFee(membership).toString() + " €";
        
        description.find("#membership").text(membership);
        description.find("#membership-fee").text(fee);
    });
});