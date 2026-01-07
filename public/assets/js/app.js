new Vue({
  el: "#app",
  data: {
    offers: [],
    activities: [],
    activitySearch: "",
    activityResults: [],
    activityLoading: false,

    loading: false,
    error: null,

    showEditModal: false,
    editForm: {},
    editError: null,
    editLoading: false,

    documentForm: {
      titulo: "",
      descripcion: "",
      archivo: null,
    },
    documentLoading: false,

    showViewModal: false,
    viewOffer: null,
    viewLoading: false,

    search: "",
    meta: {
      page: 1,
      per_page: 10,
      last_page: 1,
      total: 0,
    },

    form: {
      objeto: "",
      descripcion: "",
      moneda: "",
      presupuesto: "",
      actividad_id: null,
      actividad_text: "",
      fecha_inicio: "",
      hora_inicio: "",
      fecha_cierre: "",
      hora_cierre: "",
    },

    formLoading: false,
    formError: null,
  },

  mounted() {
    this.fetchOffers();
    this.fetchActivities();
  },

  methods: {
    fetchOffers(page = 1) {
      this.loading = true;
      this.error = null;

      api
        .get("/ofertas", {
          params: {
            search: this.search,
            page: page,
            per_page: this.meta.per_page,
          },
        })
        .then((response) => {
          this.offers = response.data.data;
          this.meta = response.data.meta;
        })
        .catch(() => {
          this.error = "Error al cargar las ofertas";
        })
        .finally(() => {
          this.loading = false;
        });
    },

    createOffer() {
      this.formLoading = true;
      this.formError = null;

      api
        .post("/ofertas", this.form)
        .then(() => {
          Swal.fire({
            icon: "success",
            title: "Oferta creada",
            text: "La oferta fue creada correctamente",
          });

          this.resetForm();
          this.fetchOffers();
        })
        .catch((error) => {
          let message = "Error al crear la oferta";

          if (
            error.response &&
            error.response.data &&
            error.response.data.errors
          ) {
            message = "Verifique los datos ingresados";
          }

          Swal.fire({
            icon: "error",
            title: "Error",
            text: message,
          });
        })
        .finally(() => {
          this.formLoading = false;
        });
    },

    fetchActivities() {
      api
        .get("/actividades")
        .then((response) => {
          this.activities = response.data;
        })
        .catch(() => {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: "No se pudieron cargar las actividades",
          });
        });
    },

    searchActivities() {
      if (this.activitySearch.length < 3) {
        this.activityResults = [];
        return;
      }

      this.activityLoading = true;

      api
        .get("/actividades", {
          params: { search: this.activitySearch },
        })
        .then((response) => {
          this.activityResults = response.data;
        })
        .finally(() => {
          this.activityLoading = false;
        });
    },

    selectActivity(activity) {
      this.form.actividad_id = activity.id;
      this.form.actividad_text = activity.producto;
      this.activitySearch = activity.producto;
      this.activityResults = [];
    },

    resetForm() {
      this.form = {
        objeto: "",
        descripcion: "",
        moneda: "",
        presupuesto: "",
        actividad_id: "",
        actividad_text: "",
        fecha_inicio: "",
        hora_inicio: "",
        fecha_cierre: "",
        hora_cierre: "",
      };
    },

    changePage(page) {
      if (page < 1 || page > this.meta.last_page) {
        return;
      }
      this.fetchOffers(page);
    },

    openEditModal(offer) {
      this.editForm = { ...offer };
      this.editError = null;
      this.showEditModal = true;
    },

    closeEditModal() {
      this.showEditModal = false;
      this.editForm = {};
    },

    updateOffer() {
      this.editLoading = true;
      this.editError = null;

      api
        .put(`/ofertas/${this.editForm.id}`, this.editForm)
        .then(() => {
          Swal.fire({
            icon: "success",
            title: "Oferta actualizada",
            text: "Los cambios fueron guardados",
          });

          this.closeEditModal();
          this.fetchOffers();
        })
        .catch((error) => {
          let message = "Error al actualizar la oferta";

          if (error.response && error.response.data) {
            if (error.response.data.error) {
              message = error.response.data.error;
            } else if (error.response.data.errors) {
              message = "Verifique los datos ingresados";
            }
          }

          Swal.fire({
            icon: "error",
            title: "Error",
            text: message,
          });
        })
        .finally(() => {
          this.editLoading = false;
        });
    },

    handleFile(event) {
      this.documentForm.archivo = event.target.files[0];
    },

    uploadDocument() {
      if (!this.documentForm.archivo) {
        Swal.fire({
          icon: "warning",
          title: "Archivo requerido",
          text: "Debe seleccionar un archivo",
        });
        return;
      }

      this.documentLoading = true;

      const formData = new FormData();
      formData.append("archivo", this.documentForm.archivo);
      formData.append("titulo", this.documentForm.titulo);
      formData.append("descripcion", this.documentForm.descripcion);

      api
        .post(`/ofertas/${this.editForm.id}/documentos`, formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then(() => {
          Swal.fire({
            icon: "success",
            title: "Documento cargado",
            text: "El documento fue subido correctamente",
          });

          this.documentForm = {
            titulo: "",
            descripcion: "",
            archivo: null,
          };
        })
        .catch(() => {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: "No se pudo subir el documento",
          });
        })
        .finally(() => {
          this.documentLoading = false;
        });
    },

    openViewModal(id) {
      this.viewLoading = true;
      this.viewOffer = null;
      this.showViewModal = true;

      api
        .get(`/ofertas/${id}`)
        .then((response) => {
          this.viewOffer = response.data;
        })
        .catch(() => {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: "No se pudo cargar la oferta",
          });
          this.showViewModal = false;
        })
        .finally(() => {
          this.viewLoading = false;
        });
    },

    closeViewModal() {
      this.showViewModal = false;
      this.viewOffer = null;
    },
  },
});
