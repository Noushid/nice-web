<div class="col-md-12">
    <div class="row">
        <button class="btn btn-primary" ng-click="newBlog()"><i class="fa fa-plus"></i> Add</button>
        <form class="form-horizontal" method="POST" ng-show="showform" ng-submit="addBlog()">
            <h3>New Blog</h3><br/>
            <div class="form-group">
                <label for="" class="control-label col-md-1">Heading</label>
                <div class="col-md-8">
                    <textarea class="form-control" name="heading" ng-model="newblog.heading" required=""></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label col-md-1">Content</label>
                <div class="col-md-8">
                    <textarea class="form-control" ng-model="newblog.content" name="content" required=""></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-1" for="date">Date</label>
                <div class="col-md-4">
                    <p class="input-group">
                        <input type="text" class="form-control" name="date" uib-datepicker-popup="dd-MMMM-yyyy" ng-model="date" is-open="popup2.opened" datepicker-options="dateOptions" ng-required="true" close-text="Close" readonly show-button-bar="false"/>
                          <span class="input-group-btn">
                            <button type="button" class="btn btn-default" ng-click="open2()"><i class="glyphicon glyphicon-calendar"></i></button>
                          </span>
                    </p>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="control-label col-md-1">Photo</label>
                <div class="col-md-4">
                    <button ngf-select="uploadFiles($files, $invalidFiles)" accept="image/*" ngf-max-height="5000" ngf-max-size="5MB">Select Files</button>
                </div>
                <div class="col-md-12">
                    Files:
                    <div class="row">
                        <ul class="list-group">
                            <li ng-repeat="f in files" style="font:smaller" class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col-sm-2">
                                            <img ngf-src="f.$ngfBlobUrl" class="thumbnail" width="100px" ngf-no-object-url="true">
                                            <span>{{f.name}} {{f.$errorParam}}</span>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <div class="progress" ng-show="f.progress >= 0" ng-class="{cancel: uploadstatus == 1}">
                                                        <div ng-show="uploadstatus == 1">{{f.progressmsg}}</div>
                                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                                                             aria-valuemin="0" aria-valuemax="100" style="width:{{f.progress}}%" ng-show="uploadstatus != 1">
                                                            {{f.progress}}% Complete
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <button class="btn btn-danger" type="button" ng-click="abort()">cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                             <li ng-repeat="f in errFiles" style="font:smaller" class="list-group-item">{{f.name}} {{f.$error}} {{f.$errorParam}}
                            </li>
                        </ul>
                    </div>

                    {{errorMsg}}
                </div>
                <span class="alert alert-warning">Image should be 100*100</span>

                <!--                   for existing image-->
                <div class="clearfix"></div>
                <div class="row" ng-show="newblog.file_name" style="margin-left: 14px">
                    <div class="col-md-2">
                        <div class="thumbnail cus-thumb" ng-mouseover="showcaption=true" ng-mouseleave="showcaption=false">
                            <div class="caption" ng-show="showcaption">
                                <div id="content">
                                    <a href="" class="label label-warning" rel="tooltip" title="Show">Show</a>
                                    <a href="" class="label label-danger" rel="tooltip" title="delete" confirmed-click="deleteImage(newblog)" ng-confirm-click="Would you like to delete this item?!">delete</a>
                                </div>
                            </div>
                            <img src="{{newblog.thumbImgUrl}}" alt="thumbnails">
                        </div>
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>
            <div class="form-group text-center">
                <button class="btn btn-primary" type="submit">Save</button>
                <button class="btn btn-danger" type="button" ng-click="hideForm()">Cancel</button>
            </div>
        </form>
        <div class="row">
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
            <th>Heading</th>
            <th>Content</th>
            <th>Date</th>
            <th>image</th>
            <th>action</th>
        </tr>
        </thead>
        <tbody>
        <tr dir-paginate="blog in bloges | filter:search | limitTo:pageSize | itemsPerPage:numPerPage">
            <td>{{$index+1}}</td>
            <td>{{blog.heading}}</td>
            <td><p class="description" popover-placement="top" uib-popover="{{blog.content}}" popover-trigger="'mouseenter'">{{blog.content}}</p></td></td>
            <td><span ng-if="blog.date!='0000-00-00'">{{blog.date |date:'dd-MMM-yyyy'}}</span></td>
            <td><a href="{{blog.imgUrl}}"><img class="img img-thumbnail" src="{{blog.thumbImgUrl}}" alt="thumbnail" width="25px" height="25px"/></a></td>
            <td>
                <div  class="btn-group btn-group-xs" role="group">
                    <button type="button" class="btn btn-info" ng-click="showForm(blog)">
                        <i class="fa fa-pencil"></i>
                    </button>
                    <button  type="button" class="btn btn-danger" confirmed-click="deleteBlog(blog)" ng-confirm-click="Would you like to delete this item?!">
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