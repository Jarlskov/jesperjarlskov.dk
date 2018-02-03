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
                filter: (list) => {
                    return $.map(list, (tag) => {
                        return {name: tag};
                    });
                },
            }
        });

        available_tags.initialize();

        console.log($('#tags'));
        $('#tags').materialtags({
            typeaheadjs: [
                {
                    highlight: true,
                },
                {
                    name: 'available_tags',
                    displayKey: 'name',
                    valueKey: 'name',
                    source: available_tags.ttAdapter()
                }
            ]
        });

        /*
        console.log($('#tags').val());
        $('.tags input').change((e) => {
            console.log($(e.currentTarget).val());
            $('#tags').val($(e.currentTarget).val());
            console.log($('#tags').val());
        });
        */

        new SimpleMDE({ element: document.getElementById('post-body') });
    }
});
