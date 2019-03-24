const iconClassActive = {}

    function conviconClassActive (dat) {
        const classSelected = (dat == 1) ? 'fa fa-window-close' : 'fa fa-check'
        //console.log(val)

        return classSelected
    }

iconClassActive.install = function (Vue) {
    Vue.filter('iconClassActive',(val) => {
        return conviconClassActive(val)
    })
}
export default iconClassActive