<div>
    <div class="page-header">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="title">
                    <h4>All Post</h4>
                </div>
                <nav aria-label="breadcrumb" role="navigation">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/user/home" wire:navigate>Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            All Posts
                        </li>
                    </ol>
                </nav>
            </div>

        </div>
    </div>

    <div class="row pb-10" wire:poll>
        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">0</div>
                        <div class="font-14 text-secondary weight-500">
                            Subscribers
                        </div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#00eccf">
                            <i class="icon-copy dw dw-pin"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">80</div>
                        <div class="font-14 text-secondary weight-500">
                            Likes
                        </div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#ff5b5b">
                            <span class="icon-copy ti-heart"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">400+</div>
                        <div class="font-14 text-secondary weight-500">
                            Comments
                        </div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon">
                            <i
                                class="icon-copy fa fa-comment"
                                aria-hidden="true"
                            ></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-6 mb-20" wire:poll>
            <div class="card-box height-100-p widget-style3">
                <div class="d-flex flex-wrap">
                    <div class="widget-data">
                        <div class="weight-700 font-24 text-dark">{{$posts_count}}</div>
                        <div class="font-14 text-secondary weight-500">Posts</div>
                    </div>
                    <div class="widget-icon">
                        <div class="icon" data-color="#09cc06">
                            <i class="icon-copy fa fa-file" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Simple Datatable start -->
    <div class="card-box mb-30 p-4">

        <div class="pb-20">
            <table class="data-table table stripe hover nowrap">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">#</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Posted At</th>
                        <th>Updated At</th>
                        <th class="datatable-nosort">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr wire:key="{{$post->id}}">
                            <td class="table-plus">{{$loop->iteration}}</td>
                            <td>{{$post->post_title}}</td>
                            <td>{{$post->content}}</td>
                            <td>{{$post->created_at}}</td>
                            <td>{{$post->updated_at}}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                        href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                                        <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
                                        <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i>
                                            Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <!-- Simple Datatable End -->
</div>
