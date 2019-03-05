const payOrNot = {}

function changePayOrNot (text) {
    text = text != false ? 'Cobro' : 'Sin Cobro'
    return text
}
payOrNot.install = function (Vue) {
    Vue.filter('pay-or-not', (val) => {
        return changePayOrNot(val)
    })
}
export default payOrNot