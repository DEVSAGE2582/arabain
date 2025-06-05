@extends('layouts.admin')
@section('content')
    <style>
        #basic-6_info {
            margin: 20px 0;
        }
    </style>
    <div class="page-body">
        <!-- DataTable with Add/Edit modals -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <!-- Card Header -->
                        <div class="card-header pb-0 card-no-border d-flex justify-content-between align-items-center">
                            <h3>Bank List</h3>
                            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addBankModal">
                                Add Bank Account
                            </button>
                        </div>

                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="display" id="basic-6">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Account Name</th>
                                            <th>Bank Name</th>
                                            <th>Account Number</th>
                                            <th>Routing No.</th>
                                            <th>Branch Name</th>
                                            {{-- <th>Transaction Type</th> --}}
                                            <th>Balance</th>
                                            <th>status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($accounts as $index => $account)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $account->account_name }}</td>
                                                <td>{{ $account->bank_name }}</td>
                                                <td>{{ $account->account_number }}</td>
                                                <td>{{ $account->routing }}</td>
                                                <td>{{ $account->branch }}</td>
                                                <td>{{ $account->account_balance }}</td>

                                                <td>
                                                    <input type="checkbox" class="toggle-status"
                                                        data-id="{{ $account->id }}"
                                                        {{ $account->status ? 'checked' : '' }}>
                                                </td>

                                                <td>
                                                    <ul class="action list-inline mb-0">
                                                        <li class="list-inline-item edit">
                                                            <a href="" class="editBtn" data-id="{{ $account->id }}">
                                                                <i class="icon-pencil-alt"></i>
                                                            </a>
                                                        </li>

                                                        <li class="list-inline-item transfer">
                                                            <a href="#" class="transferBtn text-warning"
                                                                data-id="{{ $account->id }}"
                                                                data-name="{{ $account->account_name }}">
                                                                <i class="fa-solid fa-arrow-right-arrow-left"></i> </a>
                                                        </li>

                                                        <li class="list-inline-item delete">
                                                            <button type="button" class="btn btn-link text-danger p-0"
                                                                onclick="openDeleteModal({{ $account->id }})">
                                                                <i class="icon-trash"></i>
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>

                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">No Accounts found.</td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>

                                <!-- Add Bank Account Modal -->
                                <div class="modal fade" id="addBankModal" tabindex="-1" aria-labelledby="addBankModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{ route('bank.store') }}" method="POST">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addBankModalLabel">Add Bank Account</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="bank_name" class="form-label">Bank Name</label>
                                                        <input type="text" class="form-control" id="bank_name"
                                                            name="bank_name" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="account_number" class="form-label">Account
                                                            Number</label>
                                                        <input type="text" class="form-control" id="account_number"
                                                            name="account_number" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="account_name" class="form-label">Account Name</label>
                                                        <input type="text" class="form-control" id="account_name"
                                                            name="account_name" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="routing" class="form-label">Routing Number</label>
                                                        <input type="text" class="form-control" id="routing"
                                                            name="routing">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="branch" class="form-label">Branch Name</label>
                                                        <input type="text" class="form-control" id="branch"
                                                            name="branch">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="balance" class="form-label">Account Opening
                                                            Balance</label>
                                                        <input type="number" class="form-control" id="balance"
                                                            name="account_balance">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="note" class="form-label">Note</label>
                                                        <input type="text" class="form-control" id="note"
                                                            name="note">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Save Account</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>


                                <!-- Edit Bank Modal -->
                                <div class="modal fade" id="editBankModal" tabindex="-1"
                                    aria-labelledby="editBankModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form id="editBankForm" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Bank Account</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <input type="hidden" id="edit_id" name="id">
                                                    <div class="mb-3">
                                                        <label for="edit_account_name" class="form-label">Account
                                                            Name</label>
                                                        <input type="text" class="form-control" id="edit_account_name"
                                                            name="account_name" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="edit_bank_name" class="form-label">Bank Name</label>
                                                        <input type="text" class="form-control" id="edit_bank_name"
                                                            name="bank_name" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="edit_account_number" class="form-label">Account
                                                            Number</label>
                                                        <input type="text" class="form-control"
                                                            id="edit_account_number" name="account_number" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="edit_routing" class="form-label">Routing No.</label>
                                                        <input type="text" class="form-control" id="edit_routing"
                                                            name="routing">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="edit_branch" class="form-label">Branch Name</label>
                                                        <input type="text" class="form-control" id="edit_branch"
                                                            name="branch">
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Update Account</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="deleteModal" tabindex="-1"
                                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form id="deleteForm" method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    Are you sure you want to delete this Bank account?
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Fund Transfer Modal -->
                                <div class="modal fade" id="fundTransferModal" tabindex="-1"
                                    aria-labelledby="fundTransferModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{ route('bank.transfer') }}" method="POST">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Transfer Funds</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <input type="hidden" name="from_account_id" id="from_account_id">

                                                    <div class="mb-3">
                                                        <label class="form-label">From Account</label>
                                                        <input type="text" id="from_account_display"
                                                            class="form-control" disabled>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="to_account_id" class="form-label">Transfer To (Bank
                                                            Name)</label>
                                                        <select name="to_account_id" id="to_account_id"
                                                            class="form-select" required>
                                                            <option value="">-- Select Bank --</option>
                                                            @foreach ($accounts as $acc)
                                                                <option value="{{ $acc->id }}">{{ $acc->bank_name }}
                                                                    - {{ $acc->account_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="amount" class="form-label">Amount</label>
                                                        <input type="number" class="form-control" name="amount"
                                                            id="amount" min="1" step="0.01" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="operation_date" class="form-label">Date</label>
                                                        <input type="date" class="form-control" name="operation_date"
                                                            id="operation_date" required value="{{ date('Y-m-d') }}">
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="transaction_type" class="form-label">Transaction
                                                            Type</label>
                                                        <input type="text" class="form-control"
                                                            name="sub_type" id="sub_type"
                                                            placeholder="e.g., Internal Transfer" required>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Transfer</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>



                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.toggle-status').change(function() {
            let status = $(this).is(':checked') ? 1 : 0;
            let bankId = $(this).data('id');

            $.ajax({
                url: '/bank/' + bankId + '/toggle-status',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    status: status
                },
                success: function(response) {
                    console.log('Status updated:', response.new_status ? 'Active' :
                        'Inactive');
                },
                error: function() {
                    alert('Error updating status.');
                }
            });
        });
    });
</script>

<script>
    $(document).on('click', '.editBtn', function(e) {
        e.preventDefault();
        const row = $(this).closest('tr');

        const id = $(this).data('id');
        const account_name = row.find('td:eq(1)').text().trim();
        const bank_name = row.find('td:eq(2)').text().trim();
        const account_number = row.find('td:eq(3)').text().trim();
        const routing = row.find('td:eq(4)').text().trim();
        const branch = row.find('td:eq(5)').text().trim();

        $('#edit_id').val(id);
        $('#edit_account_name').val(account_name);
        $('#edit_bank_name').val(bank_name);
        $('#edit_account_number').val(account_number);
        $('#edit_routing').val(routing);
        $('#edit_branch').val(branch);

        $('#editBankForm').attr('action', '/bank/update/' + id);
        $('#editBankModal').modal('show');
    });
</script>
<script>
    function openDeleteModal(bankId) {
        const form = document.getElementById('deleteForm');
        form.action = `/bank/${bankId}`; // Make sure the route matches
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    }
</script>

<script>
    $(document).on('click', '.transferBtn', function () {
        const accountId = $(this).data('id');
        const accountName = $(this).data('name');

        $('#from_account_id').val(accountId);
        $('#from_account_display').val(accountName);

        // Hide the selected 'from account' in 'to_account' dropdown
        $('#to_account_id option').show();
        $('#to_account_id option[value="' + accountId + '"]').hide();

        $('#fundTransferModal').modal('show');
    });
</script>

