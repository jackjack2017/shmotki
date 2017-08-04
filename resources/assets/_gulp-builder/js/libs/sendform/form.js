import Field from './field';

export default class Form{
    /**
     * @param formClass {string} - class of form.
     * @param settings {Object} - settings object.
     * @param reference {Object} - reference for validation.
     */
    constructor(formClass, settings, reference) {
        this.form = document.querySelector(formClass);
        if(this.form == null || undefined) return;
        this.inputs = Array.from(this.form.querySelectorAll('input:not([type="hidden"]), select, textarea'));
        /**
         * Set action(url for request)
         */
        let action = this.form.getAttribute('action');

        this.action = action != null ? action  : '/';
 
        // Form state if it contain errors
        this.state = true;
        //determine if there are any mistakes now.    
        this.error = false;
        // Show spunner activity
        this.isSpinnerActive = false;
        // Text of status field.
        this.statusText = null;
        // Contain all field of this form
        this.items = [];
        // Contain errors field with position
        this.errorItems = {};
        // settings
        let customSettings = {
            resetAfterSubmit: true,
            onlyValidate: false,
            statusId: 'form-status',
            statusErrorClass:'with_error',
            statusSuccessClass : 'with_success',
            errorClass: 'error',
            successClass: 'success-valid',
            validateClass: '.js_sendform-validate',
            requiredClass: 'form-required', 
            modalOpen: true,
            modalId: '#thanks',
            msgSend: 'Отправка данных',
            msgDone: 'Данные успешно отправлены',
            msgError: 'Ошибка отправки',
            msgValError: 'Одно из полей не заполено',
            spinnerColor: '#000',
            formPosition: 'relative',
            resetClass: '.js_senform-reset',
            method: 'POST',
            success: data => {
                this.successSubmit();
            },
            error: data => {
                this.errorSubmit();
            },
            validationSuccess : () => {},
            validationError : () => {               
                this.validationErrorCallback();
            }
        };
        // validation rules
        let customReference = {
            email: ['isEmail', 'isEmpty'],
            text: ['isEmpty'],
            textarea: ['isEmpty'],
            phone: ['minLength'],
            required:['isEmpty'],
            checkbox:['isChecked'],
            radio:['isCheckedRadio']
        };

        this.settings = Object.assign(customSettings ,settings);
        this.reference = Object.assign(customReference, reference);

        this.onInit();
    }

    /**
     * On initialize class.
     * Creating all inputs of this form.
     * if setting for only validate true init this func.
     * else init function on submitting.
     * creating status text field.
     * init function for reset field.
     */
    onInit(){
        this.createInputsValidate();

        if(this.settings.onlyValidate){
            this.onValidate();
        }
        else{
            this.form.addEventListener('submit', event => {
                event.preventDefault();
                this.preSubmit();
            });
        }
        this.createStatusField();
        this.onReset();
    }

    /**
     * Creating for each input, select, checkboxes own class.
     * And pushing this classes into array.
    */
    createInputsValidate(){
        this.inputs.forEach((el, i)=>{
            let item = new Field(el, this.state, this.reference, this.settings, i);
            this.items.push(item);
        });
    }
    /**
     * Create hidden field for status text.
     */
    createStatusField(){
        var div = document.createElement('div');
        div.innerHTML = '';
        div.id= this.settings.statusId;
        this.form.appendChild(div);
        this.statusText = this.form.querySelector(`#${this.settings.statusId}`);
    }

    /**
     * checking on error.
     * prepare for submitting:
     * add spinner, add status text.
     * call submit function.
     */
    preSubmit(){
        this.validateField();
        if(!this.state){
            this.errorOnForm();
            return;
        }

        this.error = false;
        if(!this.isSpinnerActive) this.addSpinner();
        this.statusText.innerHTML = this.settings.msgSend;
        this.submitData();
    }

    /**
     * Foreach in all items call validation function.
     * @param result {object} - variable keep return from
     * validation function.Object contain 2 attr
     * result.valid {boolean} -show is field pass validation.
     * result.position {string} - position of field.
     * 
     */
    validateField(){
        let localState = true;
        this.items.forEach((item)=>{
            let result = item.validate();
            if (result == undefined) return;
            localState = localState * result.valid;

            if(localState){
                delete this.errorItems[result.position];
            }
            else{
                this.errorItems[result.position] = false;
            }
        });

        this.state = localState;
        if(this.state){
            this.removeStatusText();
        }
    }

    /**
     * Call reset method on all items.
     */
    resetField(){
        this.items.forEach((item)=>{
            item.resetSelf();
        });
    }

    /**
     * Adding spinner.
     */
    addSpinner(){
        var div = document.createElement('div');
        div.innerHTML= '<div class="form-loading"></div>';
        div.id= 'formsendHover';
        this.form.appendChild(div);
        this.isSpinnerActive = true;
    }

    /**
     * Removing spinner.
     */
    removeSpinner(){
        document.querySelector('#formsendHover').remove();
        this.isSpinnerActive = false;
    }

    /**
     * init validation by press on btn.
     */
    onValidate(){
        let validateBtn = this.form.querySelector(this.settings.validateClass);
        validateBtn.addEventListener('click', (event)=>{
            event.preventDefault();
            this.validateField();
            if(this.state){
                this.settings.validationSuccess();
                return;
            }
            this.settings.validationError();
        });
    }

    /**
     * init function reseting by press btn.
     */
    onReset(){
        let resetClass = this.form.querySelector(this.settings.resetClass);
        if(resetClass == null || undefined) return;
        resetClass.addEventListener('click', ()=>{
            this.resetField();
        });
    }

    /**
     * Add text and set error on true.
     * And add text error.
     */
    errorOnForm(){  
        if(this.error) return;
        this.error = true;
        this.statusText.innerHTML = this.settings.msgValError;
        this.statusText.classList.add('with_error');
    }

    /**
     * On error validation
     */
    validationErrorCallback(){
        this.errorStatusClass();
        this.printText(this.settings.msgValError);
    }

    /**
     * Set text in status in form.
     * @param text{string}
     */
    printText(text){
        this.statusText.innerHTML = text;
    }

    /**
     * Clean status text
     */
    removeStatusText(){
        this.statusText.innerHTML = '';
        this.statusText.classList = '';
    }

    /**
     * Set error class on status text in form
     */
    errorStatusClass(){
        this.statusText.classList.add(this.settings.statusErrorClass);
    }

    /**
     * Set success class on status text in form
     */
    successStatusClass(){
        this.statusText.classList.add(this.settings.statusSuccessClass);
    }

    /**
     * Submitting data
     * @param event
     */
    submitData(event){  
        let request = new XMLHttpRequest();
        request.open(this.settings.method, this.action , true);
        let data = new FormData(this.form);
        request.onload = data => {
            if (request.status >= 200 && request.status < 400) {
                // Success!
                this.settings.success();
            } else {
                // We reached our target server, but it returned an error
                this.settings.error();
            }
            this.removeSpinner();
        };
        request.send(data);
    }

    /**
     * On error submit
     */
    errorSubmit(){
        this.errorStatusClass();
        this.printText(this.settings.msgError);
    }

    /**
     * On success submit
     */
    successSubmit(){
        this.successStatusClass();
        this.printText(this.settings.msgDone);
    }

}