const toUppercase = {}

function convertToUppercase (text) {
    text = text.toUpperCase()
    return text
}
toUppercase.install = function (Vue) {
    Vue.filter('toUppercase', (val) => {
        return convertToUppercase(val)
    })
}
export default toUppercase