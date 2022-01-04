import * as vue from '../_/vue.js'
import {_config}  from './config.js'

var app = new Vue({
	el:"#content",
	data:{
		moves:"",
		total_loja:"",
		moves_store:{},
		saldo_store:{
			emconta:0,
			divida:0
		},
	},
	methods:{
		send(){
			var fr = new FileReader();
            fr.onload = function() {
                var lines = this.result.split('\n');
                var data = [];
                for (var i = lines.length - 1; i >= 0; i--) {
                    data [i]={
                    "tipo":lines[i].substr(0,[1]),
                    "data":lines[i].substr(1,[8]),
                    "valor":lines[i].substr(9,[10])/100.00,
                    "cpf":lines[i].substr(19,[11]),
                    "cartao":lines[i].substr(29,[12]),
                    "hora":lines[i].substr(42,[6]),
                    "dono_da_loja":lines[i].substr(48,[14]),
                    "loja":lines[i].substr(62,[19]),
                 }
                }
	            axios.post(_config.urlBase+"importar",{data:data}).then(response=>{
	              if(response.data.success == true){
	              	app.message(response.data.message,'success');
	              	setTimeout(function(){
	              		location.reload();
	              	},1000)
	              }else{
	              	app.message(response.data.message,'error');
	              }
	            }).catch(error=>{
	            	error.response.data.message.forEach(msg=>{
	            		app.message(msg,'error');
	            	});
	            });

            }

            fr.readAsText(cnab.files[0]);
		},

		GetData(){
			axios.get(_config.urlBase+"listar").then(response=>{
				this.moves = response.data.data;
				this.total_loja = response.data.total_loja;
				setTimeout(function(){
					 $('table.moves').DataTable({
			            	//searching:false,
			                "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
					        "<'table-responsive'tr>" +
					        "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
			                "oLanguage": {
			                    "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
			                    "sInfo": "Exibindo página _PAGE_ de _PAGES_",
			                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
			                   "sLengthMenu": "Resultados :  _MENU_",
			                },
			                "stripeClasses": [],
			                "lengthMenu": [5, 10],
			                "pageLength": 5,
			            });
				},900)
			})
		},

		porNome(nome){
			axios.get(_config.urlBase+"ver-loja/"+nome).then(response=>{
				this.moves_store = response.data.movimentos;
				this.saldo_store.emconta = response.data.saldo;
				//this.saldo_store.divida = response.data.divida;
				$("table.moves-store").dataTable().fnDestroy();
				setTimeout(function(){
					 $('table.moves-store').DataTable({
			            	searching:false,
			            	"lengthChange": false,
			            	"bInfo" : false,
			                "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +
					        "<'table-responsive'tr>" +
					        "<'dt--bottom-section d-sm-flex justify-content-sm-center text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
			                "oLanguage": {
			                    "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
			                    "sInfo": "Exibindo página _PAGE_ de _PAGES_",
			                    "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
			                   "sLengthMenu": "Resultados :  _MENU_",
			                },
			                "stripeClasses": [],
			                "lengthMenu": [5, 10],
			                "pageLength": 5,
			            });
				},100)

			});
		},

		message(message,icon){
			const toast = swal.mixin({
		    toast: true,
		    position: 'top-end',
		    showConfirmButton: false,
		    timer: 3000,
		    padding: '2em'
		  });

		  toast({
		    type: icon,
		    title: message,
		    padding: '2em',
		  })
		}

	},
	computed:{
		event(){
			var cnab = document.getElementById('cnab');
			cnab.addEventListener('change',this.send());
		}
	},
	mounted(){
		this.GetData();
	}
})