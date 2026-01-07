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

    search: "",
    meta: {
      page: 1,
      per_page: 10,
      last_page: 1,
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
  },
});
