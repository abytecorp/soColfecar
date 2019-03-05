const notSwNull = {}

function convertNotSwNull (str) {
    const res= '';
    if(str != 'null'){
        res = str;
    }
    return res;
}

notSwNull.install =function (Vue) {
    Vue.filter('not-sw-null', (val) => {
        return convertNotSwNull(val)
    })
}

export default notSwNull