<div class="col-md-12" ng-class="{disable : loading} ">
    <div class="row" style="padding-left: 14px">
        <div class="box">
            <button class="btn btn-primary" ng-click="newSlideImage()"><i class="fa fa-plus"></i> Add</button>
            <form class="form-horizontal" method="POST" ng-submit="addSlideImage()" ng-show="showform" name="addform" enctype="multipart/form-data">
                <h3>New Slide Image</h3>
                <div class="form-group">
                    <label for="" class="control-label col-md-1">Photo</label>
                    <div class="col-md-4">
                        <button ngf-select="uploadFiles($files, $invalidFiles)"
                                accept="image/*"
                                ngf-max-height="5000"
                                ngf-max-size="5MB"
                                ngf-multiple="true">
                            Select Files
                        </button>
                        <span class="alert alert-danger"ng-show="fileValidation.status == true">{{fileValidation.msg}}</span>
                        <br><br>
                        Files:

                        <ul>
                            <li ng-repeat="f in files" style="font:smaller">
                                <img ngf-src="f.$ngfBlobUrl" class="thumbnail" width="100px" ngf-no-object-url="true" >
                                {{f.name}} {{f.$errorParam}}
                                <div class="progress" ng-show="f.progress >= 0">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                                         aria-valuemin="0" aria-valuemax="100" style="width:{{f.progress}}%">
                                        {{f.progress}}% Complete
                                    </div>
                                </div>

                            </li>
                            <li ng-repeat="f in errFiles" style="font:smaller">{{f.name}} {{f.$error}} {{f.$errorParam}}
                            </li>
                        </ul>
                        {{errorMsg}}
                    </div>
                    <span class="alert alert-warning">Image should be 100*100</span>

                    <!----for existing image----->
                    <div class="clearfix"></div>


                    <div class="clearfix"></div>
                </div>
                <div class="container" ng-show="show_error">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="alert alert-danger alert-dismissable fade in ">
                                <a href="" class="close" data-dismiss="alert" arial-label="close">&times;</a>
                                <h4>following files are not uploaded</h4>
                                <p ng-repeat-start="err in error">{{err}}</p>
                                <hr ng-repeat-end />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-primary" type="submit">Save</button>
                    <button class="btn btn-danger" type="button" ng-click="hideForm()">Cancel</button>
                </div>
            </form>
        </div>
        <div class="clearfix"></div>
        <hr/>
        <div class="row">
            <div class="container-fluid">
                <div class="row">
                    <div class="row" style="margin-left: 14px">
                        <div class="col-md-2" dir-paginate="(key,preview) in slideimages | filter:search | limitTo:pageSize | itemsPerPage:numPerPage">
                            <div class="thumbnail cus-thumb" ng-mouseover="showcaption=true" ng-mouseleave="showcaption=false" style="max-height: 142px;min-height: 142px">
                                <div class="caption" ng-show="showcaption">
                                    <div id="content">
                                        <a href="{{preview.imgUrl}}" class="label label-warning" rel="tooltip" title="Show">Show</a>
                                        <a href="" class="label label-danger" rel="tooltip" title="Delete" confirmed-click="deleteImage(preview)" ng-confirm-click="Would you like to delete this item?!">Delete</a>
                                    </div>
                                </div>
                                <img src="{{preview.imgUrl}}" alt="thumbnails">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pull-right">
                    <dir-pagination-controls
                        max-size="10"
                        direction-links="true"
                        boundary-links="true">
                    </dir-pagination-controls>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="loading" ng-show="loading">
    <div id="loading-image">
        <img src="<?php echo public_url() . 'assets/admin/img/loading.gif' ?>" alt=""/>
        <h4>Please wait...</h4>
    </div>
</div>