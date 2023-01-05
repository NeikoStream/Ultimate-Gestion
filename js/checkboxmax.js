//REGARDER POUR LIMIT CHECKBOX ici : https://stackoverflow.com/questions/19001844/how-to-limit-the-number-of-selected-checkboxes

$('input[type=checkbox]').on('change', function (e) {
    if ($('input[type=checkbox]:checked').length > 3) {
        $(this).prop('checked', false);
        alert("allowed only 3");
    }
});