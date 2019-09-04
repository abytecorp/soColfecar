<template>
    <div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <h5 class="card-title">{{ event.event || 'Cree los planes del evento'}}</h5>
                            <h6 class="card-subtitle">Nuevo plan</h6>
                        </div>
                        <div class="ml-auto">
                            <button class="pull-right btn btn-circle btn-success" v-on:click="isNewRow()" ><i class="ti-plus"></i></button>
                        </div>
                    </div>
                    <div v-if="isNew">
                        <form v-on:submit.prevent="storePlan" class="form-material m-t-40">
                            <div class="form-group">
                                <FloatingLabel
                                    :config="{label: 'Nombre del plan (*)', hasError: formErr.plan, hasClearButton: false }">
                                    <input name="planName" type="text" id="planName" v-model="newPlan.plan" >
                                </FloatingLabel>
                                <span v-if="formErr.plan" class="text-danger">{{ formErr.plan }}</span>
                            </div>
                            <div class="form-group">
                                <FloatingLabel
                                    :config="{label: 'Descripcion del plan', hasError: false, hasClearButton: false }">
                                    <input name="planDescription" type="textarea" id="planDescription" v-model="newPlan.pl_desc" >
                                </FloatingLabel>
                                <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.pl_desc }}</span>
                            </div>
                            <div class="form-group">
                                <FloatingLabel
                                    :config="{label: 'Valor del plan (si este plan no cuenta con un valor dejelo en 0)', hasError: false, hasClearButton: false }">
                                    <input name="planPrice" type="number" id="planPrice" v-model="newPlan.price" >
                                </FloatingLabel>
                                <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.price }}</span>
                            </div>
                            <div class="form-group">
                                <FloatingLabel
                                    :config="{label: 'Almuerzos', hasError: false, hasClearButton: false }">
                                    <input name="planLunches" type="number" id="planLunches" v-model="newPlan.lunches" >
                                </FloatingLabel>
                                <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.lunches }}</span>
                            </div>
                            <div class="form-group">
                                <FloatingLabel
                                    :config="{label: 'Refrigerios', hasError: false, hasClearButton: false }">
                                    <input name="planRefreshments" type="number" id="planRefreshments" v-model="newPlan.refreshments" >
                                </FloatingLabel>
                                <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.refreshments }}</span>
                            </div>
                            <div class="form-group">
                                <FloatingLabel
                                    :config="{label: 'Cenas', hasError: false, hasClearButton: false }">
                                    <input name="planDinner" type="number" id="planDinner" v-model="newPlan.dinner" >
                                </FloatingLabel>
                                <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.dinner }}</span>
                            </div>
                            <div class="form-group">
                                <FloatingLabel
                                    :config="{label: 'Desayunos', hasError: false, hasClearButton: false }">
                                    <input name="planBreakfast" type="number" id="planBreakfast" v-model="newPlan.breakfast" >
                                </FloatingLabel>
                                <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.breakfast }}</span>
                            </div>

                            <div class="form-group">
                                <h6 class="text-muted">Agenda Academica</h6>
                                    <select class="form-control form-control-success" name="" id="" v-model="newPlan.academic_agenda">
                                        <option value="1">SI</option>
                                        <option value="0">NO</option>
                                    </select>
                                <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.academic_agenda }}</span>
                            </div>
                            <div class="form-group">
                                <h6 class="text-muted">Hospedaje</h6>
                                    <select class="form-control form-control-success" name="" id="" v-model="newPlan.host">
                                        <option value="1">SI</option>
                                        <option value="0">NO</option>
                                    </select>
                                <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.academic_agenda }}</span>
                            </div>
                            <div class="form-group">
                                    <h6 class="text-muted">Tipo de invitación</h6>
                                        <select class="form-control form-control-success" name="" id="" v-model="newPlan.invitation_type">
                                            <option value="assistants">Asistentes</option>
                                            <option value="special-guests">Invitado Especial</option>
                                            <option value="sponsors">Staff</option>
                                        </select>
                                <span v-for="error in errors" class="text-danger" :key="error.error">{{ error.invitation_type }}</span>
                                <span v-if="formErr.invitation_type" class="text-danger">{{ formErr.invitation_type }}</span>
                            </div>
                            <dir class="form-group">
                                <button type="submit" class="btn btn-outline-info"><i class="fa fa-plus"></i> Agregar</button>
                                <button type="button" class="btn btn-outline-danger" v-on:click="isNewRow()"><i class="fa fa-times"></i> Cancelar</button>
                                
                            </dir>
                        </form>
                        <span v-if="formErr.plan" class="text-danger">{{ formErr.plan }}</span>
                    </div>
                </div>
                <div class="card-body bg-light">
                    <div class="row">
                        <!-- <div class="col-6">
                            <h3>March 2017</h3>
                            <h5 class="font-light m-t-0">Report for this month</h5></div>
                        <div class="col-6 align-self-center display-6 text-right">
                            <h2 class="text-success">$3,690</h2></div> -->
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>PLAN</th>
                                <th>VALOR</th>
                                <th>AGENDA ACADEMICA</th>
                                <th>DESAYUNOS</th>
                                <th>ALMUERZOS</th>
                                <th>CENAS</th>
                                <th>REFRIGERIOS</th>
                                <th>HOSPEDAJE</th>
                                <th>INVITACION</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody v-if="eventId">
                            <tr v-for="plan in plans" :key="plan.id" v-bind:class="{'table-warning' : plan.edit}">
                                <td class="text-center">{{ plan.id }}</td>
                                <td class="txt-oflo"><div v-if="!plan.edit">{{ plan.plan }}</div><div v-else><input type="text" v-model="plan.plan"></div></td>
                                <td class="txt-oflo"><div v-if="!plan.edit">{{ plan.price | currency }}</div><div v-else><input type="text" v-model="plan.price"></div></td>
                                <td class="text-center">
                                    <div v-if="!plan.edit">
                                        <select name="" id="" disabled v-model="plan.academic_agenda">
                                            <option value="1">SI</option>
                                            <option value="0">NO</option>
                                        </select>
                                    </div>
                                    <div v-else>
                                        <select name="" id="" v-model="plan.academic_agenda">
                                            <option value="1">SI</option>
                                            <option value="0">NO</option>
                                        </select>
                                    </div>
                                </td>
                                <td class="text-center"><div v-if="!plan.edit">{{ plan.breakfast || 'NO' }}</div><div v-else><input type="number" v-model="plan.breakfast"></div></td>
                                <td class="text-center"><div v-if="!plan.edit">{{ plan.lunches || 'NO' }}</div><div v-else><input type="number" v-model="plan.lunches"></div></td>
                                <td class="text-center"><div v-if="!plan.edit">{{ plan.dinner || 'NO' }}</div><div v-else><input type="number" v-model="plan.dinner"></div></td>
                                <td class="text-center"><div v-if="!plan.edit">{{ plan.refreshments || 'NO' }}</div><div v-else><input type="number" v-model="plan.refreshments"></div></td>
                                <td class="text-center">
                                    <div v-if="!plan.edit">
                                        <select name="" id="" disabled v-model="plan.host">
                                            <option value="1">SI</option>
                                            <option value="0">NO</option>
                                        </select>
                                    </div>
                                    <div v-else>
                                        <select name="" id="" v-model="plan.host">
                                            <option value="1">SI</option>
                                            <option value="0">NO</option>
                                        </select>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div v-if="!plan.edit">{{ plan.invitation_type || 'NO' }}</div>
                                    <div v-else>
                                        <select class="form-control form-control-success" name="" id="" v-model="plan.invitation_type">
                                            <option value="assistants">Asistentes</option>
                                            <option value="special-guests">Invitado Especial</option>
                                            <option value="sponsors">Staff</option>
                                        </select>
                                    </div>
                                </td>
                                <td class="text-center"><div v-if="plan.edit"><a href="#" v-on:click="saveRow(plan.id)"><i class="fa fa-save"></i></a></div><div v-else><a href="#" v-on:click="editRow(plan.id)"><i class="fa fa-edit"></i></a></div>
                                <a href="#" v-on:click="deleteRow(plan.id)"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        </tbody>
                        <tbody v-else>
                            <tr v-for="plan in plans" :key="plan.id" v-bind:class="{'table-warning' : plan.edit}">
                                <td class="text-center">{{ plan.id }}</td>
                                <td class="txt-oflo"><div v-if="!plan.edit">{{ plan.plan }}</div><div v-else><input type="text" v-model="plan.plan"></div></td>
                                <td class="txt-oflo"><div v-if="!plan.edit">{{ plan.price | currency }}</div><div v-else><input type="text" v-model="plan.price"></div></td>
                                <td class="text-center"><div v-if="!plan.edit">{{ plan.academic_agenda || 'NO' }}</div><div v-else><input type="number" v-model="plan.academic_agenda"></div></td>
                                <td class="text-center"><div v-if="!plan.edit">{{ plan.breakfast || 'NO' }}</div><div v-else><input type="number" v-model="plan.breakfast"></div></td>
                                <td class="text-center"><div v-if="!plan.edit">{{ plan.lunches || 'NO' }}</div><div v-else><input type="number" v-model="plan.lunches"></div></td>
                                <td class="text-center"><div v-if="!plan.edit">{{ plan.dinner || 'NO' }}</div><div v-else><input type="number" v-model="plan.dinner"></div></td>
                                <td class="text-center"><div v-if="!plan.edit">{{ plan.refreshments || 'NO' }}</div><div v-else><input type="number" v-model="plan.refreshments"></div></td>
                                <td class="text-center">
                                    <div v-if="!plan.edit">
                                        <select name="" id="" disabled v-model="plan.host">
                                            <option value="1">SI</option>
                                            <option value="0">NO</option>
                                        </select>
                                    </div>
                                    <div v-else>
                                        <select name="" id="" v-model="plan.host">
                                            <option value="1">SI</option>
                                            <option value="0">NO</option>
                                        </select>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div v-if="!plan.edit">
                                        <select class="form-control form-control-success" disabled name="" id="" v-model="plan.invitation_type">
                                            <option value="assistants">Asistentes</option>
                                            <option value="special-guests">Invitado Especial</option>
                                            <option value="sponsors">Staff</option>
                                        </select></div>
                                    <div v-else>
                                        <select class="form-control form-control-success" name="" id="" v-model="plan.invitation_type">
                                            <option value="assistants">Asistentes</option>
                                            <option value="special-guests">Invitado Especial</option>
                                            <option value="sponsors">Staff</option>
                                        </select>
                                    </div>
                                </td>
                                <td class="text-center"><div v-if="plan.edit"><a href="#" v-on:click="saveRow(plan.id)"><i class="fa fa-save"></i></a></div><div v-else><a href="#" v-on:click="editRow(plan.id)"><i class="fa fa-edit"></i></a></div>
                                <a href="#" v-on:click="deleteRow(plan.id)"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                </div>
            </div>
            <!-- <button v-if="eventId" type="submit" class="btn btn-outline-success" v-on:click="saveAllPlans()"><i class="fa fa-save"></i> Guardar</button> -->

    </div>
</template>
<script>

import VueCurrencyFilter from 'vue-currency-filter'
import FloatingLabel from 'vue-simple-floating-labels'


export default {
    props : {
        eventId :   '',
    },
    components : {
        FloatingLabel
    },
    data () {
        return {
            plans       :   [],
            event       :   [],
            errors      :   [],
            newPlan     :   {
                plan                :   '',
                pl_desc             :   '',
                price               :   '',
                academic_agenda     :   '',
                lunches             :   '',
                refreshments        :   '',
                dinner              :   '',
                breakfast           :   '',
                host                :   '',
                invitation_type     :   '',
                id_event            :   ''

            },
            isNew       :   false,
            formErr  :   {
                plan            :   null,
                pl_desc :           null,
                invitation_type :   null
            }
        }
    },
    created : function () {
        this.eventId && this.getEvent(this.eventId)
    },
    methods : {
        getEvent : function(id) {
            let url = '/api/get-events/'+id
            axios.get(url).then(response =>{
                this.event = response.data
                this.getPlans(this.event.id)
            }).catch(error => {
            this.errors = error.response.data
            });
        },
        getPlans : function(id) {
            let url = `/api/${id}/get-plans`
            axios.get(url).then(response =>{
                this.plans = response.data
            }).catch(error => {
            this.errors = error.response.data
            });
        },
        editRow : function(id) {
            this.plans = this.plans.map(function (plan) {
                plan.id==id ? plan.edit = true : plan.edit = false
                return plan
            })
        },
        saveRow : function(id) {
            this.plans = this.plans.map(function (plan) {
                plan.id==id ? plan.edit = false : plan.edit = false
                return plan
            })
        },
        deleteRow : function(id) {
            let count = 0
            let pos = 0 
            this.plans.forEach(function(plan) {
                plan.id == id ? pos = count : true
                count += 1
            })
            this.plans.splice(pos,1)
        },
        isNewRow : function() {
            this.isNew ? this.isNew = false : this.isNew = true
        },
        storePlan : function() {
            if(this.eventId){
            }else{
                if(!this.newPlan.plan){
                    this.formErr.plan = 'Debe asignar el nombre del plan';
                }else if(!this.newPlan.invitation_type){
                    this.formErr.invitation_type = 'Debe seleccionar el tipo de invitacion';
                }else{ 
                    this.newPlan.plan = this.newPlan.plan.toUpperCase();
                    this.formErr.plan = null
                    this.plans.push(new Object(this.newPlan))
                    this.$emit('setPlan',this.plans);
                    this.newPlan = {}
                    this.isNewRow()
                }
            }
        },
    }
}
</script>
