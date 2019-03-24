const classNotificationActive = {}

    function convclassNotificationActive (dat) {
        const classSelected = (dat == 1) ? 'alert alert-success alert-rounded' : 'alert alert-warning alert-rounded'
        //console.log(val)

        return classSelected
    }

classNotificationActive.install = function (Vue) {
    Vue.filter('classNotificationActive',(val) => {
        return convclassNotificationActive(val)
    })
}
export default classNotificationActive