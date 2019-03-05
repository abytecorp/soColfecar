<template>
  <div>
    <div style="margin-bottom: 10px">
      <el-row>
        <el-col :span="18">
          <el-button @click="createChapter">Crear Capitulo</el-button>
          <el-button @click="showConf">Configuraciones</el-button>
          <el-button @click="bulkDelete">bulk delete</el-button>
        </el-col>

        <el-col :span="6">
          <el-input placeholder="Buscar" v-model="filters[0].value"></el-input>
        </el-col>
      </el-row>
    </div>

    <data-tables :data="data" :action-col="actionCol" :filters="filters" @selection-change="handleSelectionChange">
      <el-table-column type="selection" width="55">
      </el-table-column>

      <el-table-column v-for="title in titles" :prop="title.prop" :label="title.label" :key="title.prop" sortable="custom">
      </el-table-column>
    </data-tables>

<!-- modal new chapter -->
    <div id="modalCreateChapter" class="modal fade bs-example-modal-lg"  role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myLargeModalLabel">Nuevo Capitulo</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          </div>
          <div class="modal-body">
            <form v-on:submit.prevent="createNewChapter">
              <div class="form-group m-form__group">
                <label for="bsNameInput">Capitulo:</label>
                <input type="text" class="form-control m-input m-input--air" id="bsNameInput" aria-describedby="bsNameHelp" placeholder="Escriba el nombre o titulo del capitulo" v-model="chapter.chapter">
                <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.chapter }}</span>
              </div>
              <div class="form-group m-form__group">
                <label for="example-datetime-local-input">Fecha y hora de inicio</label>
                <input class="form-control m-input m-input--air" type="datetime-local"  id="example-datetime-local-input" v-model="chapter.date_init">
                <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.date_init }}</span>
              </div>
              <div class="form-group m-form__group">
                <label for="example-datetime-local-input" >Fecha y hora de finalizacion</label>
                <input class="form-control m-input m-input--air" type="datetime-local"  id="example-datetime-local-input" v-model="chapter.date_end">
                <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.date_end }}</span>
              </div>
              <div class="form-group m-form__group">
                <label for="bsNameInput">Descripcion:</label>
                  <textarea class="form-control" rows="5" v-model="chapter.description"></textarea>
                <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.description }}</span>
              </div>						
              <div class="form-group m-form__group">
                <label for="cityInput">Tipo de Capitulo:</label>
              <v-select :options="chapter_types"  v-model="chapter.id_chapter_type" id="cityInput">
                <template slot="option" slot-scope="option">
                  {{ option.label }}
                </template>
              </v-select>
              <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.chapter_types }}</span>
              </div>
              <div class="form-group m-form__group">
                <label for="addressInput">Este evento genera cobro por inscripcion?:</label>
                  <input type="checkbox" id="checkbox"  data-color="#009efb" v-model="chapter.is_billing" />
                  <label for="checkbox">{{ chapter.is_billing | pay-or-not }}</label>
                <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.address }}</span>
              </div>

              <div class="form-group m-form__group">
                <label for="exampleInputEmail1">Banner del Capitulo</label>
                <div></div>
                <div class="custom-file">
                  <input type="file" class="custom-file-input" @change="getBanner" id="customFile">
                  <label class="custom-file-label" for="customFile">Seleccione archivo</label>
                  <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.banner }}</span>
                </div>
                <div v-if="chapter.banner">
                  <button type="button" class="btn btn-danger" v-on:click="deleteBanner"><i class="fa fa-trash-o"></i> Eliminar</button>
                  <img class="card-img-top img-fluid" :src="chapter.banner" alt="Card image cap">
                </div>
              </div>
              <button type="submit" class="btn btn-primary">Crear</button>
					  </form>
          </div>
          <div class="modal-footer">
          </div>
            </div>
            <!-- /.modal-content -->
            </div>
        <!-- /.modal-dialog -->
    </div>

<!-- modal update chapter -->
        <div id="modalUpdateChapter" class="modal fade bs-example-modal-lg"  role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Actualizar Capitulo</h4>
                    <button type="button" class="close" v-on:click="claenVariablesUpdate">×</button>
                </div>
                <div class="modal-body">
                  <form v-on:submit.prevent="updateChapterSet(chapterUpdate.chapter_id)">
                    <div v-if="chapterUpdate.banner != null && imageData == null">
                      <button type="button" class="btn btn-danger" v-on:click="deleteBanner"><i class="fa fa-trash-o"></i> Eliminar</button>
                      <img class="card-img-top img-fluid" :src="'storage/banner/'+chapterUpdate.banner" alt="Card image cap">
                    </div>
                    <div v-else-if="chapterUpdate.banner != null && imageData != null">
                      <button type="button" class="btn btn-danger" v-on:click="deleteBanner"><i class="fa fa-trash-o"></i> Eliminar</button>
                      <img class="card-img-top img-fluid" :src="imageData" alt="Card image cap">
                    </div>
                    <div v-else>
                      <div class="form-group m-form__group">
                        <label for="exampleInputEmail1">Banner del Capitulo</label>
                        <div></div>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" @change="previewImage" id="customFileUpdate">
                          <label class="custom-file-label" for="customFile">Seleccione archivo</label>
                          <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.banner }}</span>
                        </div>
                      </div>
                    </div>
                    <div class="form-group m-form__group">
                      <label for="bsNameInput">Capitulo:</label>
                      <input type="text" class="form-control m-input m-input--air" id="bsNameInput" aria-describedby="bsNameHelp" placeholder="Escriba el nombre o titulo del capitulo" v-model="chapterUpdate.chapter">
                      <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.chapter }}</span>
                    </div>
                    <div class="form-group m-form__group">
                      <label for="example-datetime-local-input">Fecha y hora de inicio</label>
                      <input class="form-control m-input m-input--air" type="datetime-local"  id="example-datetime-local-input" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}" v-model="chapterUpdate.date_init">
                      <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.date_init }}</span>
                    </div>
                    <div class="form-group m-form__group">
                      <label for="example-datetime-local-input">Fecha y hora de finalizacion</label>
                      <input class="form-control m-input m-input--air" type="datetime-local"  id="example-datetime-local-input" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2} [0-9]{2}:[0-9]{2}" v-model="chapterUpdate.date_end">
                      <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.date_end }}</span>
                    </div>
                    <div class="form-group m-form__group">
                      <label for="bsNameInput">Descripcion:</label>
                       <textarea class="form-control" rows="5" v-model="chapterUpdate.description"></textarea>
                       <!--input type="text" class="form-control m-input m-input--air" id="bsNameInput" aria-describedby="bsNameHelp" placeholder="Ingrese las sigras" v-model="chapter.description"-->
                      <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.description }}</span>
                    </div>						
                    <div class="form-group m-form__group">
                      <label for="cityInput">Tipo de Capitulo:</label>
                    <v-select :options="chapter_types"  v-model="chapterUpdate.chapter_type" id="cityInput">
                      <template slot="option" slot-scope="option">
                        {{ option.label }}
                      </template>
                    </v-select>
                    <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.chapter_types }}</span>
                    </div>
                    <div class="form-group m-form__group">
                      <label for="addressInput">Este evento genera cobro por inscripcion?:</label>
                        <input type="checkbox" id="checkbox"  data-color="#009efb" v-model="chapterUpdate.is_billing" />
                        <label for="checkbox">{{ chapterUpdate.is_billing | pay-or-not }}</label>
                      <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.address }}</span>
                    </div>

                    <button type="submit" class="btn btn-primary">Actualizar</button>
					        </form>
                </div>
                <div class="modal-footer">                
                </div>
            </div>
            <!-- /.modal-content -->
            </div>
        <!-- /.modal-dialog -->
    </div>

<!-- modal configurations -->
    <div id="modalShowConf" class="modal fade bs-example-modal-lg"  role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="myLargeModalLabel">Configuraciones</h4>
              <button type="button" class="close" v-on:click="closeConf">×</button>
          </div>
          <div class="modal-body">
            <form v-on:submit.prevent="updateChapterSet(chapterUpdate.chapter_id)">
              <hr>
              <h4>Tipos de capitulo <button type="button" class="btn btn-info btn-rounded"><i class="fa fa-plus"></i> Nuevo</button></h4> 
              <div v-for="chapter_type in chapter_types" :key="chapter_type.id"  class="alert alert-success alert-rounded" > <i class="ti-user"></i> {{ chapter_type.chapter_type }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
              </div>

              <button type="submit" class="btn btn-primary">Actualizar</button>
					  </form>
          </div>
          <div class="modal-footer">                
          </div>
      </div>
      <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>


  </div>
</template>

 <script>
//import toastr from 'toastr'
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
Vue.use(ElementUI)
// set language to EN
import lang from 'element-ui/lib/locale/lang/es'
import locale from 'element-ui/lib/locale'


locale.use(lang)
import { DataTables, DataTablesServer } from 'vue-data-tables'
Vue.use(DataTables)
Vue.use(DataTablesServer)

import moment from 'moment'
import Swal from 'sweetalert2'
import payOrNot from '../filters/pay-or-not'

Vue.use(payOrNot)

export default {
    props: ['data'],
  data() {
    return {
      chapter: {
        chapter:          '',
        description:      '',
        id_chapter_type:  '',
        is_billing:       false,
        date_init:        '',
        date_end:         '',
        banner:           null,
      },
      chapterUpdate: {
        chapter:          '',
        description:      '',
        id_chapter_type:  '',
        is_billing:       false,
        date_init:        '',
        date_end:         '',
        banner:           null,
        
      },
      imageData:          null,//preview form image
      bannerChanged:      false,
      chapter_types:  [],
      errors: [],
      titles: [{prop:'chapter',label:'Capitulo',key:'chapter'},{prop:'date_init',label:'Fecha',key:'date_init'},{prop:'status',label:'Estado',key:'status'}],
      filters: [{
        prop: ['chapter'],
        value: ''
      }],
      actionCol: {
        props: {
          label: 'Acciones',
        },
        buttons: [{
          props: {
            type: 'primary'
          },
          handler: row => {
              this.updateChapter(row.id)
          },
          label: 'Editar'
        },{
          props: {
            type: 'danger'
          },
          handler: row => {
              //this.$emit('updateAlimentsModal', row.record_id)  
          },
          label: 'Finalizar'
        }]
      },
      selectedRow: []
    }
  },
  created: function() {
    this.getChapterTypes()
  },
  methods: {
    onCreate() {
      this.data.push({
        content: "new created",
        flow_no: "FW201601010003" + Math.floor(Math.random() * 100),
        flow_type: "Help",
        flow_type_code: "help"
      })
    },
    onCreate100() {
      [...new Array(100)].map(_ => {
        this.onCreate()
      })
    },
    handleSelectionChange(val) {
      this.selectedRow = val
    },
    bulkDelete() {
      this.selectedRow.map(row => {
        this.data.splice(this.data.indexOf(row), 1)
      })
      this.$message('Linea eliminada con exito!')
    },
    updateAssistant() {
        console.log(`its event handler ${row.id}`)
        //this.$emit('updateAssistantModal',row.id)
    },
    createChapter() {
      $('#modalCreateChapter').modal('show');
    },
    getBanner : function (e) {
      //console.log(e.target.files[0])
      var fileReader = new FileReader()
      fileReader.readAsDataURL(e.target.files[0])
      fileReader.onload = (e) => {
      this.chapter.banner = e.target.result
      }
      console.log(this.chapter)
    },
    getBannerUpdate : function (e) {
      //console.log(e.target.files[0])
      var fileReader = new FileReader()
      fileReader.readAsDataURL(e.target.files[0])
      fileReader.onload = (e) => {
      this.chapterUpdate.banner = e.target.result
      }
      this.bannerChanged = true
      console.log(this.chapter)
    },
    getChapterTypes() {
      let url = '/api/get-chapter-types';
      axios.get(url).then(response =>{
          this.chapter_types = response.data;
          this.errors = [];
      }).catch(error => {
          this.chapter_types = [];
          this.errors = error.response.data;
      });
    },
    createNewChapter() {
      var url = 'chapter/store'
        axios.post(url, this.chapter
          ).then(response => {
            //console.log(response)
            //toastr.success('Se ha creado el capitulo con exito');
            this.$emit('updateDataTable')
            $('#modalCreateChapter').modal('hide');
            this.chapter = {}
          }).catch(error => {
            this.errors = error.response.data;
      });
    },
    since : function(d) {
       return moment(d).fromNow();
    },
    updateChapter : function(id) {
        $('#modalUpdateChapter').modal('show')
        let url = '/chapter/'+ id +'/get-chapter';
        axios.get(url).then(response =>{
            this.chapterUpdate = response.data

            let charDateInit = this.chapterUpdate.date_end
            this.chapterUpdate.date_end = charDateInit.split(' ').join('T')

            let charDateEnd = this.chapterUpdate.date_init
            this.chapterUpdate.date_init = charDateEnd.split(' ').join('T')
            this.chapterUpdate.is_billing = response.data.is_billing == 1 ? true : false
            this.chapterUpdate.bannerChanged =   false
            this.bannerChanged =                 false
        }).catch(error => {
            this.errors = error.response.data
        });
    },
    deleteBanner : function() {
      this.chapterUpdate.banner = null
      this.imageData = null
      this.chapter.banner = null
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
        this.getBannerUpdate(event)
    },
    updateChapterSet : function(id) {
      this.chapterUpdate.is_billing = this.chapterUpdate.is_billing == true ? 1 : 0
      this.chapterUpdate.bannerChanged = this.bannerChanged
      let url = 'chapter/'+id
      axios.put(url, this.chapterUpdate).then(response =>{
            this.chapterUpdate.id_status =       '',
            this.chapterUpdate.user_id =         '',
            this.chapterUpdate.chapter_id =      '',
            this.chapterUpdate.chapter =         '',
            this.chapterUpdate.description=      '',
            this.chapterUpdate.id_chapter_type=  '',
            this.chapterUpdate.chapter_type=     ''
            this.chapterUpdate.created_at=       ''
            this.chapterUpdate.is_billing=       false,
            this.chapterUpdate.date_init=        '',
            this.chapterUpdate.date_end=         '',
            this.chapterUpdate.banner=           null,
            this.imageData=                      null,
            this.chapterUpdate.bannerChanged =   false,
            this.bannerChanged =                 false,
            this.$emit('updateDataTable')
            $('#modalUpdateChapter').modal('hide')
      }).catch(error => {
        this.errors = error.response.data;
      });
    },
    claenVariablesUpdate : function() {
      this.chapterUpdate.id_status =       '',
      this.chapterUpdate.user_id =         '',
      this.chapterUpdate.chapter_id =      '',
      this.chapterUpdate.chapter =         ''
      this.chapterUpdate.description=      ''
      this.chapterUpdate.id_chapter_type=  ''
      this.chapterUpdate.chapter_type=     ''
      this.chapterUpdate.created_at=       ''
      this.chapterUpdate.is_billing=       false
      this.chapterUpdate.date_init=        ''
      this.chapterUpdate.date_end=         ''
      this.chapterUpdate.banner=           null
      this.imageData=                      null
      this.chapterUpdate.bannerChanged =   false
      this.bannerChanged =                 false
      $('#modalUpdateChapter').modal('hide')
    },
    showConf : function() {
      $('#modalShowConf').modal('show')
    },
    closeConf : function() {
      $('#modalShowConf').modal('hide')
    }
  }
}
</script>