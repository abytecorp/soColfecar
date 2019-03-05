const buttonLunch= {}

function setClass(el,binding) {
    //el.class = binding.value == 0 ? 'btn btn-secondary waves-effect waves-light' : binding.value == 2 ? 'btn btn-danger waves-effect waves-light' : 'none'
    //if(binding.value == 0){
    //    el.style.class = 'btn btn-secondary waves-effect waves-light'
    //}
    el.class = !binding.value ? 'btn btn-secondary waves-effect waves-light' : 'inherit'
}

buttonLunch.install = function (Vue) {
    Vue.directive('buttonLunch',{
        bind(el,binding){
            setClass(el,binding)
        }
    })
}
export default buttonLunch