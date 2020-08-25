function isDefined(object, property)
{
    if(typeof object[property] === 'undefined') {
        return false;
    }

    return true;
}

function isStorageEnabled()
{
    if (typeof(Storage) === "undefined") {
        return false;
    } 

    return true;
}