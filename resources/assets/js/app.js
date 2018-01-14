require('./libraries');

$(document).ready(() => {
    $('select').material_select();

    if ($('#backend-post-filters').length) {
        $('#backend-post-filters').find('select').change((event) => {
            event.preventDefault();
            $('#backend-post-filters').submit();
        });
    }

    $('.dropdown-button').dropdown({
        belowOrigin: true,
    });

    $('#logout-button').click((e) => {
        e.preventDefault();
        document.getElementById('logout-form').submit();
    });

    if ($('.tags input').length) {
        var available_tags = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: {
                cache: false,
                url: '/admin/tags',
            }
        });

        $('.tags input').materialtags({
            typeaheadjs: {
                name: 'available_tags',
                displayKey: 'name',
                valueKey: 'slug',
                source: available_tags.ttAdapter()
            }
        });

        $('.tags input').change((e) => {
            $('#tags').val($(e.currentTarget).val());
        });

        new SimpleMDE({ element: document.getElementById('post-body') });
    }
});
