<template>
<!-- to show this modal have to create a event funtion `newAffiliationModal` in the father model .show --> 
<div>
                                <div id="newAffiliationModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel">Nuevo registro de empresa</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
              <div class="row el-element-overlay">
                    <div class="col-md-12">
                        <h4 class="card-title">Ingrese los datos de la nueva Empresa</h4>
                        <h6 class="card-subtitle m-b-20 text-muted">Al finalizar quedara automaticamente en estado <code>Pendiente documentaciòn</code></h6> </div>
                    <!-- <div class="col-lg-3 col-md-12">-->

                    <div class="card" v-if="company.logo != '' && imageData == null">
                        <img class="card-img-top img-responsive" :src="'storage/logos/'+company.logo" alt="Card image cap">
                        <div class="card-body">
                            <button type="button" class="btn btn-danger" v-on:click="deleteLogo"><i class="fa fa-trash-o"></i> Eliminar</button>
                        </div>
                        <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.logo }}</span>
                    </div>
 

                        <div class="card" v-if="company.logo != '' && imageData != null">
                            <div class="el-card-item">
                                <div class="el-card-avatar el-overlay-1"> <img :src="imageData"  alt="user" />
                                    <div class="el-overlay scrl-dwn">
                                        <ul class="el-info">
                                            <li><a class="btn default btn-outline" href="#" v-on:click="deleteLogo"><i class="fa fa-trash-o"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="el-card-content">
                                    <button type="button" class="btn btn-danger" v-on:click="deleteLogo"><i class="fa fa-trash-o"></i> Eliminar</button>
                                    <br/> </div>
                            </div>
                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.logo }}</span>
                        </div>

                    <div v-else>
                      <div class="form-group m-form__group">
                        <label for="exampleInputEmail1">Seleccione un archivo de imagen .png o .jpg dando click en <strong>-Browse-</strong></label>
                        <div></div>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" @change="previewImage" id="customFileUpdate">
                          <label class="custom-file-label" for="customFile">Seleccione archivo</label>
                          <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.logo }}</span>
                        </div>
                      </div>
                    </div>
                <!-- </div> -->
            </div>
                                <form v-on:submit.prevent="storeCompany">
                                    <div class="form-group row">
                                        <label for="bs_name" class="col-sm-3 control-label">Razon social*</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-building"></i></span></div>
                                                <input type="text" class="form-control" id="bs_name" v-model="company.bs_name" placeholder="Razon social de la empresa">
                                            </div>
                                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.bs_name }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="acronym" class="col-sm-3 control-label">Siglas</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-building-o"></i></span></div>
                                                <input type="text" class="form-control" id="acronym" v-model="company.acronym" placeholder="Siglas o nombre corto">
                                            </div>
                                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.acronym }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nit" class="col-sm-3 control-label">NIT</label>
                                        <div class="col-sm-7">
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-qrcode"></i></span></div>
                                                <input type="number" class="form-control" id="nit" v-model="company.nit">    
                                            </div>  
                                        </div>
                                        <div class="col-sm-2">
                                                <input type="number" class="form-control" id="verification_digit" v-model="company.verification_digit">
                                        </div>
                                         <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.nit }}</span>
                                    </div>
                                    <div class="form-group row">
                                        <label for="web" class="col-sm-3 control-label">WEB</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i class="ti-world"></i></span></div>
                                                <input type="text" class="form-control" id="web" v-model="company.web" placeholder="www.empresaejemplo.com">
                                            </div>
                                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.web }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-3 control-label">Mail Corporativo</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i class="ti ti-email"></i></span></div>
                                                <input type="text" class="form-control" id="email" v-model="company.email" placeholder="info@empresaejemplo.com">
                                            </div>
                                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.email }}</span>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group row"> -->
                                         <label for="adderess" class="col-sm-3 control-label">Direccion</label>
                                        <div class="jumbotron">
                                       
                                        <!-- <div class="col-sm-9">
                                            <div class="input-group"> -->
                                                <!-- <div class="input-group-prepend"><span class="input-group-text"><i class="ti-lock"></i></span></div> -->
                                                <address-gen :data="company.address" @upAddress="setUpAddress" @upAddressDig="setUpAddressDig" @toReset="setReset" ></address-gen>
                                            <!-- </div>
                                        </div> -->
                                        <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.address }}</span>
                                        </div>
                                    <!-- </div> -->
                                    <div class="form-group row">
                                        <label for="city" class="col-sm-3 control-label">Ciudad</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-fort-awesome"></i></span></div>
                                                    <v-select class="form-control" id="city" :options="cities" v-model="company.city"  label="city">
                                                        <template slot="option" slot-scope="option">
                                                            {{ option.city }}
                                                        </template>
                                                    </v-select>
                                            </div>
                                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.id_city }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="phone1" class="col-sm-3 control-label">Telefono</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-phone-square"></i></span></div>
                                                <input type="text" class="form-control" id="phone1" v-model="company.phone1" placeholder="Telefono principal">
                                            </div>
                                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.phone1 }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="phone2" class="col-sm-3 control-label">Telefono contacto corporativo</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-phone"></i></span></div>
                                                <input type="text" class="form-control" id="phone2" v-model="company.phone2" placeholder="Telefono contacto o sucursal">
                                            </div>
                                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.phone2 }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="phone3" class="col-sm-3 control-label">Celular</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-mobile"></i></span></div>
                                                <input type="text" class="form-control" id="phone3" v-model="company.phone3" placeholder="Celular de contacto">
                                            </div>
                                            <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.phone3 }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="phone2" class="col-sm-3 control-label">Tipo de empresa</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-retweet"></i></span></div>
                                                    <v-select class="form-control" :options="cmpTypes" v-model="company.companyTypes"  label="company_type">
                                                        <template slot="option" slot-scope="option">
                                                            {{ option.company_type }}
                                                        </template>
                                                    </v-select>
                                                <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.id_cmp_type }}</span>
                                            </div>
                                        </div>
                                    </div>
                                         <button type="submit" class="btn btn-primary">Crear</button>
                                    </form>
                                
                            </div> 
                        </div>
                    </div>
        </div>
               <div class="modal-footer">
                                                
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
    <!-- /.modal -->
</div>
</template>
<script>

import addressGen from './Address-gen'

export default {
    components: {
        addressGen
    },
    data () {
        return {
            company: {
                acronym:              '',
                address:              '',
                //afiliation_state_id:  '',
                bs_name:              '',
                created_at:           '',
                email:                '',
                city:                 null,
                id_city:              null,
                id_cmp_state:         null,
                id_company_type:      null,
                companyTypes:         null,
                id_status:            null,
                logo:                 '',
                nit:                  '',
                phone1:               '',
                phone2:               '',
                phone3:               '',
                web:                  '',
            },
            imageData:          null,
            logoChanged:        false,
            cities:             [],
            cmpTypes:           [],
            cmpStates:          [],
            changes:            [],
            companies:          [],
            nulledCompanies:    [],
            cmpsByStat:         [],
            count:              [],
            errors:             [],
            cmpStatSel:         null,
            responseTest:       []
        }
    },
    created : function (){
        this.getCompanyTypes()
        this.getCities()
    },
    methods : {
        getCities() {
            let url = '/api/get-cities';
            axios.get(url).then(response =>{
                this.cities = response.data;
                this.errors = [];
            }).catch(error => {
                this.cities = [];
                this.errors = error.response.data;
            });
            },
        getCompanyTypes : function() {
            let url = '/api/get-company-types'; //get the company types
            axios.get(url).then(response =>{
                this.cmpTypes = response.data
            }).catch(error => {
                this.errors = error.response.data
            });
        },
        storeCompany : function() {
            //this.company.is_billing = this.company.is_billing == true ? 1 : 0
            this.company.logoChanged = this.logoChanged
            this.company.id_city = this.company.city != null ? this.company.city.id : null
            this.company.id_company_type = this.company.companyTypes != null ? this.company.companyTypes.id : null
            this.company.id_cmp_state = 2
            //console.log(typeof this.company.city)
            let url = 'affiliations/store'
            axios.post(url, this.company).then(response =>{
                //this.responseTest = response.data
                this.$bus.$emit('comp-cant-up')
                this.$bus.$emit('changes-up')
                this.company.acronym=              '',
                this.company.address=              '',
                this.company.bs_name=              '',
                this.company.verification_digit=   '',
                this.company.city_id=              '',
                this.company.email=                '',
                this.company.city=                 null,
                this.company.id_company_type=      null,
                this.company.companyTypes=         null,
                this.company.id_city=              null,
                this.company.id_cmp_state=         null,
                this.company.id_status=            null,
                this.company.logo=                 '',
                this.company.nit=                  '',
                this.company.phone1=               '',
                this.company.phone2=               '',
                this.company.phone3=               '',
                this.company.web=                  '',
                this.imageData=                    null
                this.logoChanged =                 false,
                this.errors =                      [],
                $('#newAffiliationModal').modal('hide')
            }).catch(error => {
                console.log(error)
                this.errors = error.response.data;
            });
        },
        getLogoUpdate : function (e) {
            var fileReader = new FileReader()
            fileReader.readAsDataURL(e.target.files[0])
            fileReader.onload = (e) => {
            this.company.logo = e.target.result
            }
            this.logoChanged = true
        },
        deleteLogo : function() {
            this.company.logo = ''
            this.imageData = null
            this.logoChanged = false
        },
        previewImage: function(event) {
            // Reference to the DOM input element
            var input = event.target;
            // Ensure that you have a file before attempting to read it
            if (input.files && input.files[0]) {
                // create a new FileReader to read this image and convert to base64 format
                var reader = new FileReader();
                // Define a callback function to run, when FileReader finishes its job
                reader.onload = (e) => {
                    // Note: arrow function used here, so that "this.imageData" refers to the imageData of Vue component
                    // Read image as base64 and set to imageData
                    this.imageData = e.target.result;
                }
                // Start the reader job - read file as a data url (base64 format)
                reader.readAsDataURL(input.files[0]);
            }
        this.getLogoUpdate(event)
        
        },
        setUpAddress : function(val) {
        //(Addres-gen)this function used to add the nomenclature an the letters, whit spaces to build the string
        this.company.address = this.company.address + ' ' + val + ' '
        },
        setUpAddressDig : function(val) {
        //(Addless-gen)this function add the string whitout a initial space, this used in the numbers.
        this.company.address = this.company.address + val
        },
        setReset : function() {
        //(Address-gen) this function reset or erase the charset or adress that gives the object
        this.company.address = ''
        },
    }
}
</script>