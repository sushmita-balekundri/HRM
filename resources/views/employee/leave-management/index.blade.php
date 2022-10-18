@extends('layouts.master1')
 
@section('content')
   
<div class="top-content">
    <div style="float:right;"><a class="btn btn-dark btn-sqrt" href="{{ route('userleave.create') }}"> Apply Leave </a></div>
    <div><h2 >Leave Requests </h2></div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
    </div>
@endif
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div class="main-content"> 
    <div class="container table-responsive p-0"> 
    <table  id="pager" class="table auto-index wp-list-table widefat striped posts">
        <tr class="table-secondary">
            <th>No</th>
            <th>Reason</th>
            <th width="115px">Date From</th>
            <th width="115px">Date To</th>
            <th width="115px">No of Days</th>
            <th  width="200px">Action</th>
        </tr>
        
        @foreach ($userleave as $leave)
        @if(auth()->user()->emp_id == $leave->emp_id)
        <tr>
            <td></td>
            <td class="text-left">{{ $leave->reason }}</td>
            @php $date=date_create($leave->date_from); @endphp
            <td>{{date_format($date,"d/m/Y")}}</td>
            @php $date=date_create($leave->date_to); @endphp
            <td>{{date_format($date,"d/m/Y")}}</td>
            <td>{{ $leave->days }}</td>
            <td>@if($leave->status == 'approved')
                    <span class="badge badge-success">Approved</span>
                    <span style="float:right;">
                        <?php 
                        $date = new DateTime($leave->date_to);
                        $now = new DateTime();?>
                        @if($date > $now)
                        <form action="{{ route('userleave.update', $leave->id) }}" method="POST" class="form-group status">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="cancel" />
                            <button type="submit" class="badge badge-info">Cancel</button>
                        </form> 
                        @endif
                    </span>
                @elseif($leave->status == 'rejected')
                    <span class="badge badge-danger">Rejected</span>
                @elseif($leave->status == 'cancel')
                    <span class="badge badge-can">Cancelled</span>
                @elseif($leave->status == 'pending' && strtotime($leave->date_to) < strtotime('-8 days'))
                    <span class="badge badge-danger">Expired</span>
                @else
                    <span class="badge badge-warning">Pending</span>
                    <span style="float:right;">
                        <?php 
                        $date = new DateTime($leave->date_to);
                        $now = new DateTime();?>
                        @if($date > $now)
                        <form action="{{ route('userleave.update', $leave->id) }}" method="POST" class="form-group status">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="cancel" />
                            <button type="submit" class="badge badge-info">Cancel</button>
                        </form> 
                        @endif
                    </span>
                @endif
            </td>
        </tr>
        @endif
        @endforeach
    </table>
    <div id="pageNavPosition" class="pager-nav"></div>
    </div>
</div> 
@endsection


@section('scripts')
<script>
function Pager(tableName, itemsPerPage) {
    'use strict';

    this.tableName = tableName;
    this.itemsPerPage = itemsPerPage;
    this.currentPage = 1;
    this.pages = 0;
    this.inited = false;

    this.showRecords = function (from, to) {
        let rows = document.getElementById(tableName).rows;

        // i starts from 1 to skip table header row
        for (let i = 1; i < rows.length; i++) {
            if (i < from || i > to) {
                rows[i].style.display = 'none';
            } else {
                rows[i].style.display = '';
            }
        }
    };

    this.showPage = function (pageNumber) {
        if (!this.inited) {
            // Not initialized
            return;
        }

        let oldPageAnchor = document.getElementById('pg' + this.currentPage);
        oldPageAnchor.className = 'pg-normal';

        this.currentPage = pageNumber;
        let newPageAnchor = document.getElementById('pg' + this.currentPage);
        newPageAnchor.className = 'pg-selected';

        let from = (pageNumber - 1) * itemsPerPage + 1;
        let to = from + itemsPerPage - 1;
        this.showRecords(from, to);

        let pgNext = document.querySelector('.pg-next'),
            pgPrev = document.querySelector('.pg-prev');

        if (this.currentPage == this.pages) {
            pgNext.style.display = 'none';
        } else {
            pgNext.style.display = '';
        }

        if (this.currentPage === 1) {
            pgPrev.style.display = 'none';
        } else {
            pgPrev.style.display = '';
        }
    };

    this.prev = function () {
        if (this.currentPage > 1) {
            this.showPage(this.currentPage - 1);
        }
    };

    this.next = function () {
        if (this.currentPage < this.pages) {
            this.showPage(this.currentPage + 1);
        }
    };

    this.init = function () {
        let rows = document.getElementById(tableName).rows;
        let records = (rows.length - 1);

        this.pages = Math.ceil(records / itemsPerPage);
        this.inited = true;
    };

    this.showPageNav = function (pagerName, positionId) {
        if (!this.inited) {
            // Not initialized
            return;
        }

        let element = document.getElementById(positionId),
            pagerHtml = '<span onclick="' + pagerName + '.prev();" class="pg-normal pg-prev">&#171;</span>';

        for (let page = 1; page <= this.pages; page++) {
            pagerHtml += '<span id="pg' + page + '" class="pg-normal pg-next" onclick="' + pagerName + '.showPage(' + page + ');">' + page + '</span>';
        }

        pagerHtml += '<span onclick="' + pagerName + '.next();" class="pg-normal">&#187;</span>';

        element.innerHTML = pagerHtml;
    };
}

let pager = new Pager('pager', 7);
pager.init();
pager.showPageNav('pager', 'pageNavPosition');
pager.showPage(1);
</script>
@stop