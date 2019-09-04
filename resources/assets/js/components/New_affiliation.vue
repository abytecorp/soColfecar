<template>
<!-- to show this modal have to create a event funtion `newAffiliationModal` in the father model .show --> 
<div>
    <div id="newAffiliationModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myLargeModalLabel">Ingrese datos de la empresa solicitante</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30"> <div v-if="imageData"> <a href="#" v-on:click="deleteLogo" ><img :src="imageData" class="img-circle" width="150" /></a></div><div v-else >
                                    <label for="exampleInputEmail1">Seleccione un archivo de imagen .png o .jpg dando click en <strong>-Browse-</strong></label>
                                    <div></div>
                                    <div class="custom-file">
                                    <input type="file" class="custom-file-input" @change="previewImage" id="customFileUpdate">
                                    <label class="custom-file-label" for="customFile">Seleccione archivo </label>
                                    <!-- <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.banner }}</span> -->
                                    </div>
                                </div>
                                    <h4 class="card-title m-t-10">{{ company.bs_name || 'RAZON SOCIAL' }}</h4>
                                    <h6 class="card-subtitle">{{ company.acronym || 'Siglas'}}</h6>
                                    <div class="row text-center justify-content-md-center">
                                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i> <font class="font-medium">254</font></a></div>
                                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-picture"></i> <font class="font-medium">54</font></a></div>
                                    </div>
                                </center>
                            </div>
                            <div>
                                <hr> </div>
                            <div class="card-body"> <small class="text-muted">Correo Electronico </small>
                                <h6>{{ company.email || 'Aun no se asigna correo' }}</h6> <small class="text-muted p-t-30 db">Telefono</small>
                                <h6>{{ company.phone1 || 'Aun no se asigna telefono' }}</h6> <small class="text-muted p-t-30 db">Direccion</small>
                                <h6>{{ company.address || 'Un no se asigna direccion' }}</h6>
                                <div class="map-box">
                                    <progress-comp :per="per"></progress-comp>
                                </div> <small class="text-muted p-t-30 db">Social Profile</small>
                                <br/>
                                <button class="btn btn-circle btn-secondary"><i class="fa fa-facebook"></i></button>
                                <button class="btn btn-circle btn-secondary"><i class="fa fa-twitter"></i></button>
                                <button class="btn btn-circle btn-secondary"><i class="fa fa-youtube"></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Informacion</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Sucursales</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Documentacion</a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="home" role="tabpanel">
                                    <div class="card-body">
                                        <div class="profiletimeline">
                                            <div class="sl-item">
                                                <div class="sl-left"> <button data-toggle="collapse" data-target="#multiCollapseExample1" aria-expanded="false" type="button" :class="[step1 === 'success' ? classSuccess : step1 === 'error' ? classDanger : classNorm]"> 1 </button> </div>
                                                <div class="sl-right">
                                                    <div><h4><strong>Datos de la empresa</strong></h4> 
                                                    <!-- <span class="sl-date">5 minutes ago</span> -->
                                                    <div class="collapse multi-collapse" id="multiCollapseExample1">
                                                    <form class="form-material m-t-40 row">
                                                        <div class="form-group col-md-12 m-t-20"> 
                                                                <FloatingLabel
                                                                    :config="{label: 'Razon Social', hasError: err.bs_name, hasClearButton: false }">
                                                                    <input name="bs_name" v-model="company.bs_name" type="text" @keyup="validateStep1(),progressing()">
                                                                </FloatingLabel>
                                                                <span v-if="err.bs_name" class="text-danger" >{{ err.bs_name }}</span>
                                                        </div>

                                                        <div class="form-group col-md-12 m-t-20">         
                                                                <FloatingLabel
                                                                    :config="{label: 'Siglas de la empresa', hasError: false, hasClearButton: false }">
                                                                    <input name="acronym" v-model="company.acronym" type="text">
                                                                </FloatingLabel>
                                                        </div>
                                                                
                                                        <div class="form-group col-md-8 m-t-20">            
                                                                    <FloatingLabel
                                                                        :config="{label: 'NIT', hasError: err.nit, hasClearButton: false }">
                                                                        <input name="nit" v-model="company.nit" type="number" @keyup="validateNit(),validateStep1(),progressing()" @onblur="validateNit(),validateStep1(),progressing()">
                                                                    </FloatingLabel>
                                                                    <span v-if="err.nit" class="text-danger" >{{ err.nit }}</span>
                                                        </div> 
                                                    
                                                        <div class="form-group col-md-2 m-t-20"> 
                                                                    <FloatingLabel
                                                                        :config="{label: 'DV', hasError: false, hasClearButton: false }">
                                                                        <input name="dv" v-model="company.verification_digit" type="number">
                                                                    </FloatingLabel>
                                                        </div>

                                                        <div class="form-group col-md-12 m-t-20">         
                                                                <FloatingLabel
                                                                    :config="{label: 'Correo electronico principal', hasError: err.principalMail, hasClearButton: false }">
                                                                    <input name="email" v-model="company.email" type="mail" @keyup="validateStep1(),progressing()">
                                                                </FloatingLabel>
                                                                <span v-if="err.principalMail" class="text-danger" >{{ err.principalMail }}</span>
                                                        </div>

                                                        <div class="form-group col-md-12 m-t-20">         
                                                                <FloatingLabel
                                                                    :config="{label: 'Telefono oficina principal', hasError: err.principalPhone, hasClearButton: false }">
                                                                    <input name="phone1" v-model="company.phone1" type="text" @keyup="validateStep1(),progressing()">
                                                                </FloatingLabel>
                                                                <span v-if="err.principalPhone" class="text-danger" >{{ err.principalPhone }}</span>
                                                        </div>

                                                        <div class="form-group col-md-12 m-t-20">         
                                                                <FloatingLabel
                                                                    :config="{label: 'Telefono opcional', hasError: false, hasClearButton: false }">
                                                                    <input name="phone2" v-model="company.phone2" type="text">
                                                                </FloatingLabel>
                                                        </div>

                                                        <div class="form-group col-md-12 m-t-20">         
                                                                <FloatingLabel
                                                                    :config="{label: 'Celular', hasError: false, hasClearButton: false }">
                                                                    <input name="phone3" v-model="company.phone3" type="text">
                                                                </FloatingLabel>
                                                        </div>

                                                    </form>
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="sl-item">
                                                <div class="sl-left"> <button data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2 multiCollapseExample2" type="button" :class="[step2 === 'success' ? classSuccess : step2 === 'error' ? classDanger : classNorm]"> 2 </button> </div>
                                                <div class="sl-right">
                                                    <div><h4><strong>Representante Legal</strong></h4> 
                                                        <div class="collapse multi-collapse" id="multiCollapseExample2">
                                                            <form class="form-material m-t-40 row">
                                                            <div class="form-group col-md-12 m-t-20">
                                                            <FloatingLabel
                                                                :config="{label: 'Nombres del representante legal', hasError: err.LRNames }">
                                                                <input name="LRNames" v-model="legalRepresentative.names" type="text" @keyup="validateStep2(),progressing()">
                                                            </FloatingLabel>
                                                            <span v-if="err.LRNames" class="text-danger" >{{ err.LRNames }}</span>
                                                            </div>

                                                            <div class="form-group col-md-12 m-t-20">
                                                            <FloatingLabel
                                                                :config="{label: 'Apellidos del representante legal', hasError: err.LRLastNames }">
                                                                <input name="LRLastNames" v-model="legalRepresentative.last_names" type="text" @keyup="validateStep2(),progressing()">
                                                            </FloatingLabel>
                                                            <span v-if="err.LRLastNames" class="text-danger" >{{ err.LRLastNames }}</span>
                                                            </div>

                                                            <div class="form-group col-md-4 m-t-20">
                                                            <div class="form-group">
                                                                <label class="text-muted">TI</label>
                                                                <select class="form-control" v-model="legalRepresentative.type_id_id">
                                                                    <option v-for="idType in idTypes" :key="idType.id" :value="idType.id">{{idType.id_type}}</option>
                                                                </select>
                                                            </div>
                                                            <span v-if="err.LRTypeID" class="text-danger" >{{ err.LRTypeID }}</span>
                                                            </div>

                                                            <div class="form-group col-md-8 m-t-20"> 
                                                            <FloatingLabel
                                                                :config="{label: 'Numero de identificación', hasError: err.LRIdentification }">
                                                                <input name="LRIdentification" v-model="legalRepresentative.number_id" type="text" @keyup="validateStep2(),progressing()">
                                                            </FloatingLabel>
                                                            <span v-if="err.LRIdentification" class="text-danger" >{{ err.LRIdentification }}</span>
                                                            </div>

                                                            <div class="form-group col-md-12 m-t-20">
                                                            <label class="text-muted">Ciudad de expedicion del documento</label>
                                                                <select class="form-control" v-model="legalRepresentative.expedition_city_id" @keyup="validateStep2(),progressing()">
                                                                    <option v-for="city in cities" :key="city.id" :value="city.id">{{city.city}}</option>
                                                                </select>
                                                            <span v-if="err.LRExpCityID" class="text-danger" >{{ err.LRExpCityID }}</span>
                                                            </div>

                                                            <div class="form-group col-md-12 m-t-20">
                                                            <FloatingLabel
                                                                :config="{label: 'Nacionalidad', hasError: err.LRNationality }">
                                                                <input name="LRNationality" v-model="legalRepresentative.nationality" type="text">
                                                            </FloatingLabel>
                                                            <span v-if="err.LRNationality" class="text-danger" >{{ err.LRNationality }}</span>
                                                            </div>

                                                            <div class="form-group col-md-12 m-t-20">
                                                            <FloatingLabel
                                                                :config="{label: 'Profesion', hasError: err.LRProfession }">
                                                                <input name="LRProfession" v-model="legalRepresentative.profession" type="text">
                                                            </FloatingLabel>
                                                            <span v-if="err.LRProfession" class="text-danger" >{{ err.LRProfession }}</span>
                                                            </div>

                                                            <div class="form-group col-md-12 m-t-20">
                                                            <FloatingLabel
                                                                :config="{label: 'Telefono', hasError: err.LRPhoneNumber }">
                                                                <input name="LRPhoneNumber" v-model="legalRepresentative.phone_number" type="text">
                                                            </FloatingLabel>
                                                            <span v-if="err.LRPhoneNumber" class="text-danger" >{{ err.LRPhoneNumber }}</span>
                                                            </div>

                                                            <div class="form-group col-md-12 m-t-20">
                                                            <FloatingLabel
                                                                :config="{label: 'Celular', hasError: err.LRCellphone }">
                                                                <input name="cellphone" v-model="legalRepresentative.cellphone" type="text">
                                                            </FloatingLabel>
                                                            <span v-if="err.LRCellphone" class="text-danger" >{{ err.LRCellphone }}</span>
                                                            </div>

                                                            <div class="form-group col-md-12 m-t-20">
                                                            <FloatingLabel
                                                                :config="{label: 'Em@il', hasError: err.LRMail }">
                                                                <input name="mail" v-model="legalRepresentative.mail" type="mail" @keyup="validateStep2(),progressing()">
                                                            </FloatingLabel>
                                                            <span v-if="err.LRMail" class="text-danger" >{{ err.LRMail }}</span>
                                                            </div>


                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="sl-item">
                                                <div class="sl-left"> <button data-toggle="collapse" data-target="#multiCollapseExample3" aria-expanded="false" aria-controls="multiCollapseExample3 multiCollapseExample3" type="button" :class="[step3 === 'success' ? classSuccess : step3 === 'error' ? classDanger : classNorm]"> 3 </button> </div>
                                                <div class="sl-right">
                                                    <div><h4><strong>Domicilio principal</strong></h4> 
                                                        
                                                            <div class="collapse multi-collapse" id="multiCollapseExample3">
                                                                <div class="form-group col-md-12 m-t-20">
                                                                    <span>Asigne una direccion usando el panel normalizador de direcciones</span>
                                                                <address-gen :data="company.address" @upAddress="setUpAddress" @upAddressDig="setUpAddressDig" @toReset="setReset" ></address-gen>
                                                                <span v-if="err.address" class="text-danger" >{{ err.address }}</span>
                                                                </div>

                                                                <div class="form-group col-md-12 m-t-20">
                                                                    <span>Seleccione la ciudad</span>
                                                                    <v-select id="eventTypeSelect" :options="cities" v-model="company.id_city"  label="city" @input="validateStep3(),progressing()">
                                                                        <template slot="option" slot-scope="option">
                                                                            {{ option.city }}
                                                                        </template>
                                                                    </v-select>
                                                                    <span v-if="err.city" class="text-danger" >{{ err.city }}</span>
                                                                </div>

                                                                <div class="form-group col-md-12 m-t-20">
                                                                    <FloatingLabel
                                                                        :config="{label: 'Telefonos', hasError: err.LRLastNames }">
                                                                        <input name="companyPhone" v-model="company.phone" type="text">
                                                                    </FloatingLabel>
                                                                    <span v-if="err.phone" class="text-danger" >{{ err.phone }}</span>
                                                                </div>
                                                            </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="sl-item">
                                                <div class="sl-left"> <button  @click="setSocietyKind()" type="button" :class="[step4 === 'success' ? classSuccess : step4 === 'error' ? classDanger : classNorm]"> 4 </button> </div>
                                                <div class="sl-right">
                                                    <div><h4><strong>Clase de sociedad</strong></h4> 
                                                            <society-kind v-if="isSocietyKind"></society-kind>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--second tab-->
                                <div class="tab-pane" id="profile" role="tabpanel">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3 col-xs-6 b-r"> <strong>Full Name</strong>
                                                <br>
                                                <p class="text-muted">Johnathan Deo</p>
                                            </div>
                                            <div class="col-md-3 col-xs-6 b-r"> <strong>Mobile</strong>
                                                <br>
                                                <p class="text-muted">(123) 456 7890</p>
                                            </div>
                                            <div class="col-md-3 col-xs-6 b-r"> <strong>Email</strong>
                                                <br>
                                                <p class="text-muted">johnathan@admin.com</p>
                                            </div>
                                            <div class="col-md-3 col-xs-6"> <strong>Location</strong>
                                                <br>
                                                <p class="text-muted">London</p>
                                            </div>
                                        </div>
                                        <hr>
                                        <p class="m-t-30">Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries </p>
                                        <p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                                        <h4 class="font-medium m-t-30">Skill Set</h4>
                                        <hr>
                                        <h5 class="m-t-30">Wordpress <span class="pull-right">80%</span></h5>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                                        </div>
                                        <h5 class="m-t-30">HTML 5 <span class="pull-right">90%</span></h5>
                                        <div class="progress">
                                            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width:90%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                                        </div>
                                        <h5 class="m-t-30">jQuery <span class="pull-right">50%</span></h5>
                                        <div class="progress">
                                            <div class="progress-bar bg-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                                        </div>
                                        <h5 class="m-t-30">Photoshop <span class="pull-right">70%</span></h5>
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="settings" role="tabpanel">
                                    <div class="card-body">
                                        <form class="form-horizontal form-material">
                                            <div class="form-group">
                                                <label class="col-md-12">Full Name</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="Johnathan Doe" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="example-email" class="col-md-12">Email</label>
                                                <div class="col-md-12">
                                                    <input type="email" placeholder="johnathan@admin.com" class="form-control form-control-line" name="example-email" id="example-email">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Password</label>
                                                <div class="col-md-12">
                                                    <input type="password" value="password" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Phone No</label>
                                                <div class="col-md-12">
                                                    <input type="text" placeholder="123 456 7890" class="form-control form-control-line">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-12">Message</label>
                                                <div class="col-md-12">
                                                    <textarea rows="5" class="form-control form-control-line"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-12">Select Country</label>
                                                <div class="col-sm-12">
                                                    <select class="form-control form-control-line">
                                                        <option>London</option>
                                                        <option>India</option>
                                                        <option>Usa</option>
                                                        <option>Canada</option>
                                                        <option>Thailand</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <button class="btn btn-success">Update Profile</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                
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
import ProgressComp from './New-affiliation-comps/progress-comp'
import SocietyKind from './New-affiliation-comps/Society-kind'

import FloatingLabel from 'vue-simple-floating-labels'

export default {
    props: ['companies'],
    components: {
        addressGen,
        FloatingLabel,
        ProgressComp,
        SocietyKind
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
            legalRepresentative:    {
                names:                  '',
                last_names:             '',
                type_id_id:             '',
                number_id:              '',
                expedition_city_id:     '',
                nationality:            '',
                profession:             '',
                phone_number:           '',
                cellphone:              '',
                mail:                   '',
            },
            err: {
                nit:                  '',
                bs_name:              '',
                LRNames:              '',
                LRLastNames:          '',   
                LRTypeID:             '',
                LRIdentification:     '',
                LRExpCityID:          '', 
                LRMail:               '',
                address:              '',
                city:                 '',
                principalMail:        '',
                principalPhone:       ''
            },
            isSocietyKind:      false,
            imageData:          null,
            logoChanged:        false,
            cities:             [],
            cmpTypes:           [],
            cmpStates:          [],
            idTypes:            [],
            changes:            [],
            nulledCompanies:    [],
            cmpsByStat:         [],
            count:              [],
            errors:             [],
            cmpStatSel:         null,
            responseTest:       [],
            classNorm:          'btn btn-secondary btn-circle',
            classDanger:        'btn btn-danger btn-circle',
            classSuccess:       'btn btn-success btn-circle',
            step1:              '',
            step2:              '',
            step3:              '',
            step4:              '',
            step5:              '',
            step6:              '',
            per:                0,
            num:                0

        }
    },
    created : function (){
        this.getCompanyTypes()
        this.getCities()
        this.getIdTypes()
        this.$bus.$on('get-company-types', () => {
            this.getCompanyTypes()
        })
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
        getIdTypes : function() {
            let url = 'get-id-types'; //get the company types
            axios.get(url).then(response =>{
                this.idTypes = response.data
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
                this.errors = error.response.data;
                //console.log(this.errors)
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
        this.validateStep3()
        this.progressing()
        },
        setUpAddressDig : function(val) {
        //(Addless-gen)this function add the string whitout a initial space, this used in the numbers.
        this.company.address = this.company.address + val
        this.validateStep3()
        this.progressing()
        },
        setReset : function() {
        //(Address-gen) this function reset or erase the charset or adress that gives the object
        this.company.address = ''
        this.validateStep3()
        this.progressing()
        },
        findNit : function (nit){
            return this.companies.find(company => company.nit === nit)
        },
        validateBsName : function (){
            if(this.company.bs_name){
                this.err.bs_name = ''
                return true
            } else {
                this.err.bs_name = 'debe asignar la razon social de la empresa'
                return false
            }
        },
        validateNit : function() {
            let cmpTmp = []
        if(this.company.nit.length != 9){
             this.err.nit = 'El nit debe contener 9 caracteres'
             return false
         }else{
              this.err.nit = ''; this.step1 = ''
         }
        if(this.err.nit === ''){
          if(this.findNit(this.company.nit)){
              cmpTmp = this.findNit(this.company.nit)
              this.err.nit = `Este NIT pertenece a la empresa ${cmpTmp.bs_name} y su afiliacion se encuentra en el estado: ${cmpTmp.company_state}`
              this.step1 = 'error'
          }else {
                this.step1 = ''
                return true
            }} else {
                this.step1 = ''
                return true
          }
        },
        validatePrinMail : function (){
            if(this.company.email){this.err.principalMail = ''; return true}else{this.err.principalMail = 'Debe ingresar el correo principal de la empresa';return false}
        },
        validatePrinPhone : function () {
            if(this.company.phone1){this.err.principalPhone = ''; return true}else{this.err.principalPhone = 'Debe ingresar el telefono principal de la empresa'; return false}
        },
        valUniqueMail : function(){
            let mail = this.companies.find(company => company.email === this.company.email)
            //console.log(mail)
            if(mail && this.company.email){
                this.err.principalMail = `Este correo ya esta registrado con la empresa ${mail.bs_name}`
                return false
            }else{
                this.err.principalMail = ''
                return true
            }
        },
        valMailFormat : function(){
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            //console.log(re.test(String(this.company.email).toLowerCase()))
            if(!re.test(String(this.company.email).toLowerCase()) && this.company.email){
                this.err.principalMail = 'Debe registrar un correo con el formato correcto >>ejemplo@empresa.com<<'
                return false
                }else{
                    if(!this.err.principalMail){
                    this.err.principalMail = ''
                    }
                    return true
                   }
        },
        validateStep1 : function() {
            let bsNameField = this.validateBsName()
            let nitField = this.validateNit()
            let principalMail = this.validatePrinMail()
            let uniqueMail = this.valUniqueMail()
            let mailFormat = this.valMailFormat()
            let principalPhone = this.validatePrinPhone()
            //console.log(`bsNameField ${bsNameField} nitField ${nitField} principalMail ${principalMail} principalPhone ${principalPhone} uniqueMail ${uniqueMail} mailFormat ${mailFormat}`)
            if(bsNameField && nitField && principalMail && principalPhone && uniqueMail && mailFormat){this.step1 = 'success'}else{ this.step1 = 'error'}
        },
        validateRPNames : function () {
            if(this.legalRepresentative.names){this.err.LRNames =  ''; return true}else{this.err.LRNames = 'Debe ingresar los nombres del representante legal'; return false}
        },
        validateRPLastNames : function (){
            if(this.legalRepresentative.last_names){this.err.LRLastNames = ''; return true}else{this.err.LRLastNames = 'Debe ingresar los apellidos del representante legal'; return false}
        },
        validateRPTI : function (){
            if(this.legalRepresentative.type_id_id){this.err.LRTypeID = ''; return true}else{this.err.LRTypeID = 'Debe seleccionar el tipo de identificaion'; return false}
        },
        validateNumberID : function (){
            if(this.legalRepresentative.number_id){this.err.LRIdentification = ''; return true}else{this.err.LRIdentification = 'Debe ingresar numero de udentificacion del representante legal'; return false}
        },
        validateRPcity : function () {
            if(this.legalRepresentative.expedition_city_id){this.err.LRExpCityID = ''; return true}else{this.err.LRExpCityID = 'Debe seleccionar la ciudad de expedicion del documento'; return false}
        },
        validateRPMail : function(){
            if(this.legalRepresentative.mail){this.err.LRMail = ''; return true}else{this.err.LRMail = 'Debe ingresar el correo del representante legal'; return false}
        },
        validateStep2 : function() {
            let RPNames = this.validateRPNames()
            let RPLastNames = this.validateRPLastNames()
            let RPTI = this.validateRPTI()
            let RPNumberID = this.validateNumberID()
            let RPCity = this.validateRPcity()
            let RPMail = this.validateRPMail()
            //console.log(`the rpnames ${RPNames} the rplasnames ${RPLastNames} the rpti ${RPTI} the rpnumberid ${RPNumberID} the rpcity ${RPCity} the rpmail ${RPMail}`)
            if(RPNames && RPLastNames && RPTI && RPNumberID && RPCity && RPMail){
                this.step2 = 'success'
            }else{
                this.step2 = 'error'
            }
        },
        validateAddress : function() {
            if(this.company.address){this.err.address = '';return true}else{this.err.address = 'Debe ingresar la direccion';return false}
        },
        validateCity : function() {
            if(typeof(this.company.id_city) === 'object'){this.err.city = ''; return true}else{this.err.city = 'Debe seleccionar la ciudad'; return false}
        },
        validateStep3 : function() {
            let address = this.validateAddress()
            let city = this.validateCity()
            if(address && city){
                this.step3 = 'success'
            }else{
                this.step3 = 'error'
            }
        },
        progressing : function() {
            
            let num1 = this.step1 === 'success' ? 1 : 0
            let num2 = this.step2 === 'success' ? 1 : 0
            let num3 = this.step3 === 'success' ? 1 : 0
            let num4 = this.step4 === 'success' ? 1 : 0
            this.num = num1 + num2 + num3 + num4
            this.per = 8.333333333333333 * this.num
        },
        setSocietyKind : function(){
            this.isSocietyKind = !this.isSocietyKind
        }
    }
}
</script>