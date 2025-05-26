@extends('layouts.master')
<link href="https://cdn.jsdelivr.net/npm/vue-select@3.20.3/dist/vue-select.min.css" rel="stylesheet">


@section('content')

<div class="page-wrapper" id="travelcategory">
    <!-- Page Content -->
    <div class="content container-fluid">

        <div class="row" id="payslip-section">
            <div class="col-12">
                <section class="review-section information">
                    <div class="row" style="display:contents">
                        <div class="review-header text-center">
                            <h3 class="review-title">Travel Category</h3>
                            <h3>
                                <p class="text-muted"><span class="badge bg-inverse-warning">Manage</span></p>
                            </h3>
                        </div>

                        <div class="table">
                            <table class="table table-bordered table-nowrap review-table mb-0">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="form-group col-3">
                                                    <label for="asset_id">Division</label>
                                                    <v-select label="name" data-index="1" :options="divisions" v-model="division_object"></v-select>

                                                </div>
                                                <div class="form-group col-2">
                                                    <label for="quantity"> Category</label>
                                                    <v-select label="name" data-index="1" :options="categories" v-model="category_object"></v-select>
                                                </div>

                                                <div class="form-group col-3">
                                                    <label for="quantity"> Travel Allowance</label>
                                                    <v-select label="name" data-index="1" :options="allowances" v-model="allowance_object"></v-select>
                                                </div>

                                                <div class="form-group col-3">
                                                    <label for="quantity">Amount</label><br>
                                                    <input type="text" class="form-control" v-model.number="category_amount">
                                                </div>

                                                <div class="form-group col-1">
                                                    <label for="quantity">.</label><br>
                                                    <button type="button" @click="toBottom()" class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>


                <section class="review-section information">
                    <div class="row" style="display:contents">

                        <!-- Child Start -->
                        <div v-if="child.length > 0" class="card-body pt-0">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="row">
                                            <div class="form-group col-3">
                                                <label for="asset_id">Division</label>
                                            </div>
                                            <div class="form-group col-3">
                                                <label for="asset_id">Category</label>
                                            </div>
                                            <div class="form-group col-3">
                                                <label for="asset_id">Allowance</label>
                                            </div>
                                            <div class="form-group col-2">
                                                <label for="asset_id">Amount</label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="row" v-for="(c, k) in child" :key="k">

                                    <div class="col-md-3">
                                        <input readonly type="text" class="form-control" :value="c.division_name" autocomplete="off" />
                                    </div>
                                    <div class="col-md-3">
                                        <input readonly type="text" class="form-control" :value="c.category_name" autocomplete="off" />
                                    </div>
                                    <div class="col-md-3">
                                        <input readonly type="text" class="form-control" :value="c.allowance_name" autocomplete="off" />
                                    </div>
                                    <div class="col-md-2">
                                        <input readonly type="text" class="form-control" :value="c.amount" autocomplete="off" />
                                    </div>

                                    <div class="col-md-1">
                                        <button style="background:red; border-color:red;" type="button" @@click="deleteData(k)" class="btn btn-success"><i class="fa fa fa-times" aria-hidden="true"></i></button>
                                    </div>
 
                            </div>
                        
                            </tbody>
                            <div class="row">
                            <div class="col-sm-2 mt-2">
                                <button class="btn btn-success" @click="sumbitData()" data-index="7">Save</button>
                                <form id="asset_form" class="form-horizontal" method="post" action="{{ route('travel.category.allowance.store') }}">
                                    @csrf
                                    <input type="hidden" id="assetdata" name="data">
                                </form>
                            </div>
                            </div>
                           

                        </div>
                        <!-- Child end -->


                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- /Page Content -->
</div>



<!-- Main content -->


<!-- Script Code -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-select@3.20.3/dist/vue-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.2.1/axios.min.js" integrity="sha512-zJYu9ICC+mWF3+dJ4QC34N9RA0OVS1XtPbnf6oXlvGrLGNB8egsEzu/5wgG90I61hOOKvcywoLzwNmPqGAdATA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>
    Vue.component('v-select', VueSelect.VueSelect);

    var app = new Vue({
        el: '#travelcategory',

        data: {
            divisions: @json($divisions),
            categories: @json($categories),
            allowances: @json($allowances),

            division_object: "",
            category_object: "",
            allowance_object: "",
            category_amount: 0,

            child: [],


        },

        methods: {
            async toBottom() {
                vm = this;
                const dataToCheck = {
                    division_id: vm.division_object.id,
                    category_id: vm.category_object.id,
                    allowance_id: vm.allowance_object.id
                };
                const response =  await axios.post('/api/check-travel-category-allowance', dataToCheck);
                if (response.data.exists) {
                    // If combination exists, show message and suggest editing
                    Swal.fire({
                        icon: 'warning',
                        title: 'Already Exists',
                        text: 'This combination already exists in the system! Please go to the edit section to modify it.',
                        showConfirmButton: true
                    });
                    return; // Prevent adding the duplicate data
                }

                if (vm.category_amount == 0) {
                    // Show an error message using SweetAlert2
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Amount Should be greater than 0',
                        showConfirmButton: true
                    });
                    return; // Prevent adding duplicate division
                }

                let divisionExists = vm.child.some(c => c.division_id != vm.division_object.id);

                // Check if the same combination of division, category, and allowance exists in the child array
                let combinationExists = vm.child.some(c => 
                    c.division_id === vm.division_object.id && 
                    c.category_id === vm.category_object.id && 
                    c.allowance_id === vm.allowance_object.id
                );

                if (divisionExists) {
                    // Show an error message using SweetAlert2
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'At a time you only add one division data!',
                        showConfirmButton: true
                    });
                    return; // Prevent adding duplicate division
                }

                if (combinationExists) {
                    // Show an error message if the combination of division, category, and allowance already exists
                    Swal.fire({
                        icon: 'error',
                        title: 'Already Added',
                        text: 'This combination of Division, Category, and Allowance is already added!',
                        showConfirmButton: true
                    });
                    return; // Prevent adding the same combination again
                }



                vm.child.push({
                    'division_id': vm.division_object.id,
                    'division_name': vm.division_object.name,
                    'category_id': vm.category_object.id,
                    'category_name': vm.category_object.name,
                    'allowance_id': vm.allowance_object.id,
                    'allowance_name': vm.allowance_object.name,
                    'amount': vm.category_amount,
                });
              
                vm.allowance_object = "";
                vm.category_amount = 0;
            },
            deleteData(k) {
                    this.child.splice(k, 1)
            },
            sumbitData() {
                    var vm = this;
                    var formData = {};
                    formData.child = vm.child;
                    vm.formData = JSON.stringify(formData);
                    document.getElementById("assetdata").value = vm.formData;
                    document.getElementById("asset_form").submit();

            },
        },
        computed: {


        }


    })
</script>



@endsection