@extends('layouts.back-end.app')

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
<style>
    table {
        min-width: max-content;
    }
</style>
@section('title')
    Customer -Page
@endsection

@section('content')
    <div class="content-wrapper" id="app">
        <div class="container-fluid">

            <div class="row" style="margin-top: 20px">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <!-- Search -->
                            <form>
                                <div class="input-group input-group-merge input-group-flush">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tio-search"></i>
                                        </div>
                                    </div>
                                    <input id="datatableSearch_" type="search" name="search" class="form-control"
                                        placeholder="Search Brands" aria-label="Search orders" value="hp"
                                        required="">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </form>
                            <!-- End Search -->
                            {{-- <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Add Agent
                            </a>  --}}
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addAgent"> Add
                                Customer</button>

                        </div>
                        <div class="card-body" style="padding: 0">
                            <div class="table-responsive">
                                <table style="text-align: left;"
                                    class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Sl</th>
                                            <th scope="col">Customer Name</th>
                                            <th scope="col">Zone/Area</th>
                                            <th scope="col">Division</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Mobile Number</th>
                                            <th scope="col">Customer Address</th>
                                            <th scope="col" style="width: 100px" class="text-center">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ 1 }}</td>
                                            <td>@{{ lists.f_name + ' ' + lists.l_name }}</td>
                                            <td>@{{ lists.street_address }}</td>
                                            <td>@{{ lists.city }}</td>
                                            <td>@{{ lists.email }}</td>
                                            <td>@{{ lists.phone }}</td>
                                            <td>@{{ lists.street_address }}</td>
                                            <td>action</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                        </div>
                    </div>
                </div>
            </div>
        </div>




        {{-- Model End --}}



    </div>



    @push('script')
        <script>
            const app = new Vue({
                el: '#app',
                data: {

                    lists: [],

                },
                methods: {

                    view() {
                        const token = this.validToken()
                        // const token = localStorage.getItem('token');
                        localStorage.setItem('token', token);

                        let config = {
                            headers: {
                                'Authorization': 'Bearer ' + token
                            }
                        }
                        axios.get(
                                'https://ecom.excelitaiportfolio.com/api/v1/customer/info',
                                config
                            )
                            .then((response) => {
                                console.log(response)
                                this.lists = response.data;
                            })
                            .catch(error => {
                                console.log(error.response)
                            })
                    },
                    validToken() {
                        return 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMmY1ZmZhNzcyNDllYzUyYjQ0MWZjOGE4ODkwY2M5ZjAyNTcwZDMwNjViZGU5NmJjMzFiMTdjMGEyMWQ4YmIxZjM2NzJhN2E0YmY5ZTA0YjciLCJpYXQiOjE2NjQ2MDI1NzMuNzg1MTk0LCJuYmYiOjE2NjQ2MDI1NzMuNzg1MTk4LCJleHAiOjE2OTYxMzg1NzMuNzc4ODc4LCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.iaJfxtQn9ChkxxFcPvY-m-pjGXMiFp_J-AS8RSgbuYOsd79NeJt7GoddkQ-Ci_wygDMwNpxCjqQ7MMfGLbZDn3Vn_6XNYvpBJMCUviuHYaVQ8noMXFAwxyAVW9iph85cjdREqA4jX2QT14bwIS2KQwjepNwe0tnvDw_2urexITv9BGmAZzL3LFRml_UX-lf-ELJ3NVzUzQd5K3kTdUbV-8HFMx8yVumyT-c69Z9e4zpj3a6HNhTmbybo2MmCsMXwfHBmh_oo9rfHs9awdIaZ4u3F_0iCPE9Ka0LPjxoLMt3ynv2jY6RnQOxYJPlfJ4P-Uqztc4PnyPDAoeXkeVNr4XSt0vDTs4R2dSlr1PrFmoPUsa1T1nDDIbiAlgKJmNVLRKm7fKJkI2sPyIlzQGdLjzVzp1iookKsw-Dw9XzhuQTUp8k9b_pycPtBEIBo717Xk4qniIzJpv0OhdzFTvq1jDXDwo9YcFlhXxtBBxb0KxuYYoMWfPfntR06fwc1sbmVWlTgZcEOER-jz3Ll4OPr40_uttLqVM_EdDP9V8gH3vef5A_aXHa8I5y13aUM6if0fqaOeTL75ZmRpe2G2JK0TQPWOno2gPly4ek4kv7IrpkHTt96i877UYVwJNbcsg-8SKII0Pun14jLVA-E8D4LevEm4rqsTvzd81pR4KzLhDo'
                    }

                },
                mounted() {
                    this.view();
                }
            })
        </script>
    @endpush

    </body>

    </html>
@endsection
