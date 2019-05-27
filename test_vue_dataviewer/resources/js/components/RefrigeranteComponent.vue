<template>

  <div id="refrigerante">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">refrigerantes</h4>
            <div class="card-tools" style="position: absolute;right: 1rem;top: .5rem;">
              <button type="button" class="btn btn-info" @click="create">
                Add New
                <i class="fas fa-plus"></i>
              </button>
              <button type="button" class="btn btn-primary" @click="reload">
                Reload
                <i class="fas fa-sync"></i>
              </button>
            </div>
          </div>

          <div class="card-body">


                <div class="mb-3">
                  <div class="row">
                    <div class="col-md-2">
                      <strong>Search By :</strong>
                    </div>
                    <div class="col-md-3">
                      <select v-model="queryFiled" class="form-control" id="fileds">
                        <option value="marca">Marca</option>
                        <option value="tipo">Tipo</option>
                        <option value="sabor">Sabor</option>
                      </select>
                    </div>
                    <div class="col-md-7">
                      <input v-model="query" type="text" class="form-control" placeholder="Search">
                    </div>
                  </div>
                </div>



                 <div class="table-responsive">
              <table class="table table-hover table-bordered table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Sabor</th>
                    <th scope="col">Litragem</th>
                    <th scope="col">Val Unid</th>
                    <th scope="col">Qtde</th>
                    <th scope="col" class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
               
                  <tr
                    v-show="refrigerantes.length"
                    v-for="(refrigerante, index) in refrigerantes"
                    :key="refrigerante.id"
                  >
                    <th scope="row">{{ index + 1 }}</th>
                    <td>{{ refrigerante.marca}}</td>
                    <td>{{ refrigerante.tipo }}</td>
                    <td>{{ refrigerante.sabor }}</td>
                    <td>{{ refrigerante.litragem }}</td>
                    <td>{{ refrigerante.valor_unidade }}</td>
                    <td>{{ refrigerante.quantidade }}</td>
                    <td class="text-center">
                      <button type="button" @click="show(refrigerante)" class="btn btn-info btn-sm">
                        <i class="fas fa-eye"></i>
                      </button>
                      <button type="button" @click="edit(refrigerante)" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit"></i>
                      </button>
                      <button
                        type="button"
                        @click="destroy(refrigerante)"
                        class="btn btn-danger btn-sm"
                      >
                        <i class="fas fa-trash-alt"></i>
                      </button>
                    </td>
                  </tr>
                  <tr v-show="!refrigerantes.length">
                    <td colspan="6">
                      <div class="alert alert-danger" role="alert">Sorry :( No data found.</div>
                    </td>
                  </tr>
                
                </tbody>
              </table>
             <pagination
                v-if="pagination.last_page > 1"
                :pagination="pagination"
                :offset="5"
                @paginate="query === '' ? getData() : searchData()"
              ></pagination>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div
      class="modal fade"
      id="refrigeranteModalLong"
      tabindex="-1"
      role="dialog"
      aria-labelledby="refrigeranteModalLongTitle"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5
              class="modal-title"
              id="refrigeranteModalLongTitle"
            >{{ editMode ? "Edit" : "Add New" }} Refrigerante</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
         
          <form @submit.prevent="editMode ? update() : store()" @keydown="form.onKeydown($event)">
            <div class="modal-body">
              <alert-error :form="form"></alert-error>
              <div class="form-group">
                <label>Marca</label>
                <input
                  v-model="form.marca"
                  type="text"
                  name="marca"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('marca') }"
                >
                <has-error :form="form" field="marca"></has-error>
              </div>
              <div class="form-group">
                <label>Tipo</label>
                <!--<input
                  v-model="form.tipo"
                  type="tipo"
                  name="tipo"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('tipo') }"
                >-->
                 <select
                  v-model="form.tipo"
                  type="text"
                  name="tipo"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('tipo') }">
                    <option value="p">Pet</option>
                    <option value="g">Garrafa</option>
                    <option value="l">Lata</option>
                  </select>
                <has-error :form="form" field="tipo"></has-error>
              </div>
              <div class="form-group">
                <label>Sabor</label>
                <input
                  v-model="form.sabor"
                  type="text"
                  name="sabor"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('sabor') }"
                >
                <has-error :form="form" field="sabor"></has-error>
              </div>
              <div class="form-group">
                <label>Litragem</label>
               <!-- <input
                  v-model="form.litragem"
                  name="litragem"
                  type="text"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('litragem') }"
                >-->
                <select v-model="form.litragem"
                  name="litragem"
                  type="text"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('litragem') }">
                    <option value="250ml">250ml</option>
                    <option value="600ml">600ml</option>
                    <option value="1l">1l</option>
                    <option value="1,5l">1,5l</option>
                    <option value="2l">2l</option>
                    <option value="3l">3l</option>
                  </select>
                <has-error :form="form" field="litragem"></has-error>
              </div>
              <div class="form-group">
                <label>Valor Unid</label>
                <input
                  v-model="form.valor_unidade"
                  type="number"
                  step="0.01"
                  name="valor_unidade"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('valor_unidade') }"
                >
                <has-error :form="form" field="valor_unidade"></has-error>
              </div>
              <div class="form-group">
                <label>Qtde</label>
                <input
                  v-model="form.quantidade"
                  type="number"
                  name="quantidade"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('quantidade') }"
                >
                <has-error :form="form" field="quantidade"></has-error>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button :disabled="form.busy" type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
         
        </div>
      </div>
    </div>
    <!-- Modal -->
   
    <div
      class="modal fade"
      id="showModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="showModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="showModalLabel">{{ form.marca }}</h5>

            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <strong>Marca : {{ form.marca }}</strong>
            <br>
            <strong>Tipo : {{ form.tipo }}</strong>
            <br>
            <strong>Sabor : {{ form.sabor }}</strong>
           <br>
            <strong>Litragem : {{ form.litragem }}</strong>
            <br>
            <strong>Val Unid : {{ form.valor_unidade }}</strong>
            <br>
            <strong>Qtde : {{ form.quantidade}}</strong>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
   
    <vue-progress-bar></vue-progress-bar>
    <vue-snotify></vue-snotify>
  </div>

    
</template>

<script>
export default {

  
  data() {
    return {
      editMode: false,
      query: "",
      queryFiled: "marca",
      refrigerantes: [],
      form: new Form({
        id: "",
        marca: "",
        tipo: "",
        sabor: "",
        litragem: "",
        valor_unidade: "",
        quantidade:""
      }),
      pagination: {
        current_page: 1
      }
    };
  },
  watch: {
    query: function(newQ, old) {
      if (newQ === "") {
        this.getData();
      } else {
        this.searchData();
      }
    }
  },
  mounted() {
    this.getData();
  },
  methods: {
    getData() {
      this.$Progress.start();
      axios
        .get("/api/refrigerantes?page=" + this.pagination.current_page)
        .then(response => {
          this.refrigerantes = response.data.data;
          this.pagination = response.data.meta;
          this.$Progress.finish();
        })
        .catch(e => {
          console.log(e);
          this.$Progress.fail();
        });
    }
  
   
    ,
    searchData() {
      this.$Progress.start();
      axios
        .get(
          "/api/search/refrigerantes/" +
            this.queryFiled +
            "/" +
            this.query +
            "?page=" +
            this.pagination.current_page
        )
        .then(response => {
          this.refrigerantes = response.data.data;
          this.pagination = response.data.meta;
          this.$Progress.finish();
        })
        .catch(e => {
          console.log(e);
          this.$Progress.fail();
        });
    }
    ,
    reload() {
      this.getData();
      this.query = "";
      this.queryFiled = "marca";
      this.$snotify.success("Data Successfully Refresh", "Success");
    },
    create() {
      this.editMode = false;
      this.form.reset();
      this.form.clear();
      $("#refrigeranteModalLong").modal("show");
    },
   
    store() {
      this.$Progress.start();
      this.form.busy = true;
      this.form
        .post("/api/refrigerantes")
        .then(response => {
          this.getData();
          $("#refrigeranteModalLong").modal("hide");
          if (this.form.successful) {
            this.$Progress.finish();
            this.$snotify.success("refrigerante Successfully Saved", "Success");
          } else {
            this.$Progress.fail();
            this.$snotify.error(
              "Something went wrong try again later.",
              "Error"
            );
          }
        })
        .catch(e => {
          this.$Progress.fail();
          console.log(e);
        });
    }
    ,
  
    show(refrigerante) {
      this.form.reset();
      this.form.fill(refrigerante);
      $("#showModal").modal("show");
      console.log(refrigerante);
    },
    edit(refrigerante) {
      this.editMode = true;
      this.form.reset();
      this.form.clear();
      this.form.fill(refrigerante);
      $("#refrigeranteModalLong").modal("show");
    },

   
    update() {
      this.$Progress.start();
      this.form.busy = true;
      this.form
        .put("/api/refrigerantes/" + this.form.id)
        .then(response => {
          this.getData();
          $("#refrigeranteModalLong").modal("hide");
          if (this.form.successful) {
            this.$Progress.finish();
            this.$snotify.success("refrigerante Successfully Updated", "Success");
          } else {
            this.$Progress.fail();
            this.$snotify.error(
              "Something went wrong try again later.",
              "Error"
            );
          }
        })
        .catch(e => {
          this.$Progress.fail();
          console.log(e);
        });
    },
   
    destroy(refrigerante) {
   //   this.$snotify.clear();
      this.$snotify.confirm(
        "You will not be able to recover this data!",
        "Are you sure?",
        {
          showProgressBar: false,
          closeOnClick: false,
          pauseOnHover: true,
          buttons: [
            {
              text: "Yes",
              action: toast => {
                this.$snotify.remove(toast.id);
                this.$Progress.start();
                axios
                  .delete("/api/refrigerantes/" + refrigerante.id)
                  .then(response => {
                    this.getData();
                    this.$Progress.finish();
                    this.$snotify.success(
                      "refrigerante Successfully Deleted",
                      "Success"
                    );
                  })
                  .catch(e => {
                    this.$Progress.fail();
                    console.log(e);
                  });
              },
              bold: true
            },
            {
              text: "No",
              action: toast => {
                this.$snotify.remove(toast.id);
              },
              bold: true
            }
          ]
        }
      );
    }
  
  }
 
};
</script>
