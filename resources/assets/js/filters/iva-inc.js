const ivaInc = {}

function convertIvaInc (val) {
    val = parseInt(val) + parseInt(val)*0.19
    return val;
}
ivaInc.install = function (Vue) {
    Vue.filter('ivaInc', (val) => {
        return convertIvaInc(val)
    })
}
export default ivaInc