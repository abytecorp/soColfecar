const onlyHours =  {}

function  setOnlyHour (dateFull) {
    var now = new Date(dateFull)
    return now.toLocaleTimeString('it-IT')
} 

onlyHours.install = function (Vue) {
    Vue.filter('only-hour', (val) => {
        return setOnlyHour(val)
    })
}
export default onlyHours