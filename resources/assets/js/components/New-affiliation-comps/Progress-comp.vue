<template>
    <div>
        <div class="card">
            <div class="card-body">
                <div class="row p-t-10 p-b-10">
                    <!-- Column -->
                    <div class="col p-r-0">
                        <h2 class="font-light">{{ Math.floor(per/5.0) * 5+' %' }}</h2>
                        <h6 class="text-muted">New Clients</h6></div>
                    <!-- Column -->
                    <div class="col text-right align-self-center">
                        <div :data-label="Math.floor(per/5.0) * 5+'%'" :class="`css-bar m-b-0 css-bar-primary css-bar-${Math.floor(per/5.0) * 5}`"><i class="mdi mdi-account-circle"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        per: {
            default: false
        }
    }
}
</script>