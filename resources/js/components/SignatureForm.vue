<template>
    <div>
        <div class="alert alert-success" v-if="saved">
            <strong>Hecho!</strong> Tu comentario se ha publicado exitosamente.
        </div>

        <div class="well well-sm" id="signature-form">
            <form class="form-horizontal" method="post" @submit.prevent="onSubmit">
                <fieldset>
                    <legend class="text-center">Escribe un comentario</legend>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="name">Nombre</label>
                        <div class="col-md-9" :class="{'has-error': errors.name}">
                            <input id="name"
                                   v-model="signature.name"
                                   type="text"
                                   placeholder="Tu Nombre"
                                   class="form-control">
                            <span v-if="errors.name" class="help-block text-danger">{{ errors.name[0] }}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="email">Tu correo electronico</label>
                        <div class="col-md-9" :class="{'has-error': errors.email}">
                            <input id="email"
                                   v-model="signature.email"
                                   type="text"
                                   placeholder="Tu correo"
                                   class="form-control">
                            <span v-if="errors.email" class="help-block text-danger">{{ errors.email[0] }}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="body">Tu comentario</label>
                        <div class="col-md-9" :class="{'has-error': errors.body}">
                                    <textarea class="form-control"
                                              id="body"
                                              v-model="signature.body"
                                              placeholder="Por favor escribe tu comentario aqui..."
                                              rows="5"></textarea>
                            <span v-if="errors.body" class="help-block text-danger">{{ errors.body[0] }}</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-primary btn-lg">Aceptar</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                errors: [],
                saved: false,
                signature: {
                    name: null,
                    email: null,
                    body: null,
                }
            };
        },

        methods: {
            onSubmit() {
                this.saved = false;

                axios.post('api/signatures', this.signature)
                    .then(({data}) => this.setSuccessMessage())
                    .catch(({response}) => this.setErrors(response));
            },

            setErrors(response) {
                this.errors = response.data.errors;
            },

            setSuccessMessage() {
                this.reset();
                this.saved = true;
            },

            reset() {
                this.errors = [];
                this.signature = {name: null, email: null, body: null};
            }
        }
    }
</script>