jQuery(document).ready(function ($) {
    let pluginName = '';
    let $licenseError = null;
    const $deactivateLink = $(`a.gurmehub-deactivate-reason`);
    const deactivateLinkHref = $deactivateLink.attr('href');

    if ($licenseError) {
        const $notice = $licenseError.parent('p').parent('div');
        $notice.removeClass('notice-warning');
        $notice.addClass('notice-error');
    }

    $deactivateLink.click((e) => {
        pluginName = $(`a.gurmehub-deactivate-reason`).data('attr-plugin-name');
        setEvenetListeners();
        $licenseError = $(`span.gph-license-error-${pluginName}`);

        e.preventDefault();
        openModal()
    });

    const setEvenetListeners = () => {

        $(`a#${pluginName}-skip-reason`).on('click', (e) => {
            e.preventDefault();
            const reasons = [
                {
                    value: "skipped",
                    label: 'skipped'
                }
            ];
            submitReasons({
                reasons
            })
        });

        $(`button#${pluginName}-cancel-modal`).on('click', () => {
            closeModal()
        });

        $(`button#${pluginName}-submit-reason`).on('click', () => {
            const reasons = [];
            const comment = $(`#${pluginName}-reason-comment`).val();
            if (comment) {
                reasons.push({
                    value: "comment",
                    label: comment
                })
            }
            $(`input[name="${pluginName}-deactivate-reason"]:checked`).each(function () {
                reasons.push({
                    value: $(this).val(),
                    label: $(this).data('label')
                });
            });

            if (0 === reasons.length) {
                $(`.${pluginName}-deactivate-reason-checkbox`).css('border', '1px solid red');
            } else {
                submitReasons({
                    reasons,
                })
            }

        });
    }

    const deactivate = () => {
        closeModal();
        window.location.href = deactivateLinkHref;
    }

    const openModal = () => {
        $(`#${pluginName}-deactivate-reason-modal-area`).css('display', 'flex');
    }

    const closeModal = () => {
        $(`#${pluginName}-deactivate-reason-modal-area`).css('display', 'none');
    }

    const submitReasons = (data) => {
        const url = `${window.gph.ajax_url}?action=${pluginName}_deactivate_reasons&_wpnonce=${window.gph.nonce}`;
        $.ajax({
            url,
            type: 'POST',
            data,
            success: deactivate(),
            error: deactivate()
        })
    }

    $('.gph-modal-area').on('click', function (e) {
        if (e.target !== this) {
            return;
        }
        $('.gph-modal').css('transform', 'scale(0.9)');
        setTimeout(() => {
            $('.gph-modal').css('transform', 'scale(1)');
        }, 50);
    });
});