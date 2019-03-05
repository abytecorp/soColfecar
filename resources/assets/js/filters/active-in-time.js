const activeInTime = {}

    function convActiveInTime (dat) {
        const val = Date.parse(dat)
        const actual_date = new Date();
        const final_date = (val >= actual_date) ? 'En curso' : 'Finalizado'
        //console.log(val)

        return final_date
    }

activeInTime.install = function (Vue) {
    Vue.filter('active-in-time',(val) => {
        return convActiveInTime(val)
    })
}
export default activeInTime