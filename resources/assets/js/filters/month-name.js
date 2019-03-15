const monthName = {}

    function convMonthName (dat) {
        const months = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"]
        const named = months[dat-1]
        return named
    }

monthName.install = function (Vue) {
    Vue.filter('month-name',(val) => {
        return convMonthName(val)
    })
}
export default monthName