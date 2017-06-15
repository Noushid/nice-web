<div class="col-md-12">
    <div class="row">
        <div class="box" style="margin-left: 14px;">
            <button class="btn btn-primary" ng-click="newLink()"><i class="fa fa-plus"></i> Add</button>
            <form class="form-horizontal" method="POST" ng-show="showform" ng-submit="addLink()">
                <h3>New Link</h3>
                <div class="form-group">
                    <label for="" class="control-label col-md-1">Name</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="name" ng-model="newlink.name" required=""/>
                    </div>
                    <label for="" class="control-label col-md-1">Link</label>
                    <div class="col-md-4">
                        <input class="form-control" type="text" ng-model="newlink.link" name="link" pattern="[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?" onblur="checkURL(this);" required=""/>
                    </div>
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-primary" type="submit">Save</button>
                    <button class="btn btn-danger" type="button" ng-click="hideForm()">Cancel</button>
                </div>
            </form>
            <form class="form-inline" ng-show="showtable">
                <div class="form-group">
                    <label for="" class="control-label col-md-2">Show</label>
                    <div class="col-md-3">
                        <select name="numPerPage" ng-model="numPerPage" class="form-control"
                                ng-options="num for num in paginations">{{num}}
                        </select>
                    </div>

                    <label class="control-label col-md-2">Search</label>
                    <div class="col-md-3">
                        <input type="text" ng-model="search" class="form-control" placeholder="Search">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="help-block" ng-show="!showtable">{{message}}</div>
    <table class="table table-bordered" ng-show="showtable">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Link</th>
            <th>action</th>
        </tr>
        </thead>
        <tbody>
        <tr dir-paginate="link in links | filter:search | limitTo:pageSize | itemsPerPage:numPerPage">
            <td>{{$index+1}}</td>
            <td>{{link.name}}</td>
            <td>{{link.link}}</td>
            <td>
                <div  class="btn-group btn-group-xs" role="group">
                    <button type="button" class="btn btn-info" ng-click="showForm(link)">
                        <i class="fa fa-pencil"></i>
                    </button>
                    <button  type="button" class="btn btn-danger" confirmed-click="deleteLink(link)" ng-confirm-click="Would you like to delete this item?!">
                        <i class="fa fa-trash-o"></i>
                    </button>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    <dir-pagination-controls
        max-size="10"
        direction-links="true"
        boundary-links="true" >
    </dir-pagination-controls>
</div>

<div id="loading" ng-show="loading">
    <div id="loading-image">
        <img src="<?php echo public_url() . 'assets/admin/img/loading.gif' ?>" alt=""/>
        <h4>Please wait...</h4>
    </div>
</div>