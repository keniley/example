function reload(result)
{
    if(isStorageEnabled() && isDefined(result, 'system')) {
        let type = 'success';
        if(isDefined(result.system, 'code')) {
            if(result.system.code !== 200) {
                type = 'danger';
            }
        }

        if(isDefined(result.system, 'message')) {
            localStorage.setItem('toastr-type', type);
            localStorage.setItem('toastr-message', result.system.message);
        }
    }

    location.reload();
}