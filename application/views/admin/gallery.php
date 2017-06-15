<div class="col-md-12" ng-class="{disable : loading} ">
    <div class="row" style="padding-left: 14px">
        <div class="box">
            <button class="btn btn-primary" ng-click="newGallery()"><i class="fa fa-plus"></i> Add</button>
            <form class="form-horizontal" method="POST" ng-submit="addGallery()" ng-show="showform" name="addform" enctype="multipart/form-data">
                <h3>New Gallery</h3>
                <div class="form-group">
                    <label for="" class="control-label col-md-1">Name</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="name" ng-model="newgallery.gallery_name" placeholder="special character Not allowed ( !@#$%^&*() )"/>
                    </div>
                    <label for="" class="control-label col-md-1">Description</label>
                    <div class="col-md-4">
                        <textarea class="form-control" name="description" ng-model="newgallery.description"></textarea>
                    </div>
                </div>
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
                        <span class="alert alert-danger" ng-show="fileValidation.status == true">{{fileValidation.msg}}</span>
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
<!--                                                        <button class="btn btn-danger" type="button" ng-click="abort()">cancel</button>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="bg-danger" ng-repeat="f in errFiles" style="font:smaller" class="list-group-item">{{f.name}} {{f.$error}} {{f.$errorParam}}
                                </li>
                            </ul>
                        </div>
                        <div class="row" ng-show="errorMsg">
                            <div class="alert alert-danger">
                                {{errorMsg}}
                            </div>
                        </div>
                    </div>
                    <span class="alert alert-warning">Image should be 100*100</span>

                    <!----for existing image----->
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-2" ng-repeat="(key,preview) in item_files">
                            <div class="thumbnail cus-thumb" ng-mouseover="showcaption=true" ng-mouseleave="showcaption=false" style="max-height: 142px;min-height: 142px">
                                <div class="caption" ng-show="showcaption">
                                    <div id="content">
                                        <a href="" class="label label-warning" rel="tooltip" title="Show">Show</a>
                                        <a href="" class="label label-danger" rel="tooltip" title="Delete" confirmed-click="deleteImage(preview)" ng-confirm-click="Would you like to delete this item?!">Delete</a>
                                    </div>
                                </div>
                                <img src="{{preview.thumbImgUrl}}" alt="thumbnails">
                            </div>
                        </div>
                    </div>

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
                    <div class="col-lg-3" dir-paginate="gallery in galleries | filter:search | limitTo:pageSize | itemsPerPage:numPerPage">
                        <div class="cuadro_intro_hover thumbnail" style="background-color:#cccccc;">
                            <p style="text-align:center;">
                                <img class="img-responsive" style="cursor:pointer;" src="{{gallery.files[0].thumbImgUrl}}" alt="{{gallery.name}}" />
                            </p>
                            <div class="caption">
                                <div class="blur"></div>
                                <div class="caption-text">
                                    <h3 style="border-top:2px solid white; border-bottom:2px solid white; padding:10px;">{{gallery.gallery_name}}</h3>
                                    <p>{{gallery.description}}</p>
                                    <button type="button" style="color: initial;" class="btn btn-default" data-toggle="modal" data-target="#gallery" ng-click="showGalleryFiles(gallery)">Open</button>
                                    <button type="button" style="color: initial;" class="btn btn-info" ng-click="ShowForm(gallery)">edit</button>
                                    <button type="button" style="color: initial;" class="btn btn-danger" confirmed-click="deleteGallery(gallery)" ng-confirm-click="Would you like to delete this item?!">delete</button>
                                </div>
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
                <div class="modal" id="gallery" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4>{{galleryfiles.gallery_name}}</h4>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-2" ng-repeat="file in galleryfiles.files">
                                        <div class="thumbnail img-responsive">
                                            <a href="{{file.imgUrl}}">
                                                <img src="{{file.thumbImgUrl}}" alt="{{file.file_name}}"/>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                            </div>
                        </div>
                    </div>
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