var auth_login = new Vue({
  el: "#data-vue",

  data: {
    items: [],

    page: 1,
    perpage: 20,
    search: "",
    current_page: 1,
    total_page: 1,
    count_start: 1,
  },

  methods: {
    get_all: function () {
      let self = this;

      let datasend = {
        params: {
          page: this.current_page,
          limit: this.perpage,
          search: this.search,
        },
      };

      let url = "/admin/pembayaran/all";
      axios.get(url, datasend).then((response) => {
        self.items = response.data.data;
        self.total_page = response.data.totalpage;
        self.count_start = (that.current_page - 1) * that.perpage + 1;
      });
    },

    pagination: function (pagejump, event) {
      event.preventDefault();
      if (
        this.current_page + pagejump >= 1 &&
        this.current_page + pagejump <= this.total_page
      ) {
        this.current_page = this.current_page + pagejump;
        this.get_all();
      }
    },
  },

  mounted: function () {
    this.get_all();
  },
});
