<template>
    <div class="modal fade" :id="ModalName" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> {{title }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        {{ message }}
        <div class="form-group" v-for=" (input, index) in inputsName">
            <label for="recipient-name" class="col-form-label">{{ input }}</label>
            <select v-if="isSelect(index)"  class="form-control form-control-sm" aria-label="اختر نوع النقاط" v-model="inputValues[index]">
              <option v-for=" (Option) in selectOptions[0]" :value="Option">{{ Option }}</option>
            </select>
           <input v-else :type="inputsType.includes(index)?inputsType[index]: 'text' "  v-model="inputValues[index]"  :name="input" class="form-control" id="recipient-name" />
        </div>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
        <button type="button"  @click="doAction" class="btn btn-primary" data-dismiss="modal">حفظ </button>
      </div>
    </div>
  </div>
</div>
</template>
<script>   
export default {
    props: {
        ModalName:String,
        inputsName:[],
        inputsType:[],
        selectOptions:[],
        message: String,
        title:String,
        action:String,
    },
    data(){
      return{
        inputValues: [], // Array to hold the values of the inputs

      }

    },
    methods:{
      isSelect(index){
        if (this.inputsType && this.inputsType.length > index) {
          console.log(this.inputsType[index]);
          return this.inputsType[index] === 'select';
        } else {
          return false;
        }
      },
      doAction(){
        this.$emit(this.action, ...this.inputValues);
        this.inputValues=[];
      }
    }
}
</script>