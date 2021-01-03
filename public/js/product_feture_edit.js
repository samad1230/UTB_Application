


    if (document.readyState == "loading"){


        document.addEventListener('DOMContentLoaded', ready)
    }else {
        ready();
    }

    function ready() {

       var  slag = $('#product_slag').val();
        $.ajax({
            type: 'GET',
            url: '/product_feturedata/'+slag,
            success:function (data){
               // console.log(data);
                var feature = data;
                hasFratureView(feature);
             }

        });

        function hasFratureView(feature){
            if(feature.length > 0){
            // console.log(feature);
                for(var i = 0; i < feature.length; i++){
                    $('.productFeatureContent').append('<div class="featureGroupContent">\n' +
                        '    <div align="right" class="pt-2">\n' +
                        '        <a href="javascript:void(0);" class="removeFeatureGroupBtnWithData" style="margin-bottom: 0;" id="'+ feature[i].id +'"><img src="'+ base_url+'/Media/image/remove-icon.png"></a>\n' +
                        '    </div>\n' +
                        '    <label for="productFeatureGroup">Feature Group Name</label>\n' +
                        '    <input type="text" id="productFeatureGroup" name="feature_group_name[]" class="form-control form-control-rounded featureGroupName" value="'+ feature[i].name  +'" placeholder="Feature Group Name" required readonly/>\n' +
                        '\n' +
                        '    <div class="addFeatureBtnContent py-2">\n' +
                        '        <button type="button" class="btn btn-warning w-50 addFeatureBtn">Add Feature</button>\n' +
                        '    </div>\n' +
                        '\n' +
                        '    <div class="col-sm-12 featureContent">\n' +
                        '\n' +
                        '    </div>\n' +
                        '</div>');

                    var featureContent = document.getElementsByClassName('featureGroupContent')[i];
                    // for(var y = 0; y < featureContent.length; y++){
                        var featureAddBtn = featureContent.getElementsByClassName('addFeatureBtn')[0];

                        featureAddBtn.addEventListener('click', features);
                    // }

                    if(feature[i].featuresItem.length > 0){
                        var faetureContent = featureContent.getElementsByClassName('featureContent')[0];
                        var inputBox = feature[i].name.replace(/\s/g,'');


                        for(var x = 0; x < feature[i].featuresItem.length; x++){
                            var content = document.createElement('biv');
                            content.classList.add('singleFeature');

                            var singleFeatureContentItemFromServer = '<div align="right">\n' +
                                '        <a href="javascript:void(0);" class="removeFeatureBtnWithData" style="margin-bottom: 0;" id="'+ feature[i].featuresItem[x].id +'"><img src="'+ base_url+'/Media/image/remove-icon.png"></a>\n' +
                                '    </div>\n' +
                                '    <label for="'+inputBox+'Name">Feature Name</label>\n' +
                                '    <input type="text" id="featureName"  class="form-control form-control-rounded '+inputBox+'Name" value="'+ feature[i].featuresItem[x].feature_name +'" placeholder="Feature Name" required readonly/>\n' +
                                '\n' +
                                '    <label for="'+inputBox+'Material">Feature Material</label>\n' +
                                '    <input type="text" id="featureMaterial" class="form-control form-control-rounded '+inputBox+'Material" value="'+ feature[i].featuresItem[x].material +'" placeholder="Feature Material" required readonly/>';

                            content.innerHTML = singleFeatureContentItemFromServer;
                            faetureContent.append(content);
                        }
                    }
                }

            }
            var removeFeatureGroupBtn = document.getElementsByClassName('removeFeatureGroupBtnWithData');
            for(var i = 0; i < removeFeatureGroupBtn.length; i++){
                var btn = removeFeatureGroupBtn[i];
                btn.addEventListener('click', removeFeatureGroupWithData);
            }

            var removeFeatureBtn = document.getElementsByClassName('removeFeatureBtnWithData');
            for(var i = 0; i < removeFeatureBtn.length; i++){
                var btn = removeFeatureBtn[i];
                btn.addEventListener('click', removeFeatureWithData);
            }
        }

    var fetureMainContent = document.getElementsByClassName('productFeatureContent')[0];
    var addFeatureGroupBtn = document.getElementsByClassName('addFeatureGroupBtn')[0];
        addFeatureGroupBtn.addEventListener('click', addFeatureGroup);
        var base_url = window.location.origin;

        function addFeatureGroup(){
            $('.productFeatureContent').append('<div class="featureGroupContent">\n' +
                '    <div align="right" class="pt-2">\n' +
                '        <a href="javascript:void(0);" class="removeFeatureGroupBtn" style="margin-bottom: 0;"><img src="'+ base_url+'/Media/image/remove-icon.png"></a>\n' +
                '    </div>\n' +
                '    <label for="productFeatureGroup">Feature Group Name</label>\n' +
                '    <input type="text" id="productFeatureGroup"  class="form-control form-control-rounded featureGroupName" name="feature_group_name[]" value="" placeholder="Feature Group Name" required/>\n' +
                '\n' +
                '    <div class="addFeatureBtnContent py-2">\n' +
                '        <button type="button" class="btn btn-warning w-50 addFeatureBtn">Add Feature</button>\n' +
                '    </div>\n' +
                '\n' +
                '    <div class="col-sm-12 featureContent">\n' +
                '\n' +
                '    </div>\n' +
                '</div>');

            var featureContent = document.getElementsByClassName('featureGroupContent');


            for(var i = 0; i < featureContent.length; i++){
                var featureAddBtn = featureContent[i].getElementsByClassName('addFeatureBtn')[0];

                featureAddBtn.addEventListener('click', features);
            }

            var removeFeatureGroupBtn = document.getElementsByClassName('removeFeatureGroupBtn');
            for(var i = 0; i < removeFeatureGroupBtn.length; i++){
                var btn = removeFeatureGroupBtn[i];
                btn.addEventListener('click', removeFeatureGroup);
            }
        }

        function removeFeatureGroup(event){
            var button = event.target;
            button.parentElement.parentElement.parentElement.remove();
        }

        function removeFeatureGroupWithData(event){
            var button = event.target;
            var featureGroup_id = button.parentElement.id;
            //console.log(featureGroup_id);
            $.ajax({
                url: '/feature_group_remove',
                type: 'post',
                data: {
                    "feature_group":featureGroup_id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                success: function(data){
                    button.parentElement.parentElement.parentElement.remove();
                },

            });
            // button.parentElement.parentElement.parentElement.remove();
        }

        function features(event){
            var button = event.target;
            var faetureContent = button.parentElement.parentElement;
            var fratureGroupName = faetureContent.getElementsByClassName('featureGroupName')[0].value;
            if(fratureGroupName != ''){
                addFeatures(event, fratureGroupName);
            }else{

                faetureContent.getElementsByClassName('featureGroupName')[0].focus();
            }
        }

        function addFeatures(event, fratureGroupName){
            var button = event.target;
            var faetureContent = button.parentElement.parentElement.getElementsByClassName('featureContent')[0];

            var content = document.createElement('biv');
            content.classList.add('singleFeature');

            var inputBox = fratureGroupName.replace(/\s/g,'');

            var singleFeatureContentItem = '<div align="right">\n' +
                '        <a href="javascript:void(0);" class="removeFeatureBtn" style="margin-bottom: 0;"><img src="'+ base_url+'/Media/image/remove-icon.png"></a>\n' +
                '    </div>\n' +
                '    <label for="'+inputBox+'Name">Feature Name</label>\n' +
                '    <input type="text" id="featureName"  class="form-control form-control-rounded '+inputBox+'Name" name="'+ inputBox +'_name[]" value="" placeholder="Feature Name" required/>\n' +
                '\n' +
                '    <label for="'+inputBox+'Material">Feature Material</label>\n' +
                '    <input type="text" id="featureMaterial" class="form-control form-control-rounded '+inputBox+'Material" name="'+ inputBox +'_material[]" value="" placeholder="Feature Material" required/>'
            content.innerHTML = singleFeatureContentItem;

            faetureContent.append(content);

            var removeFeatureBtn = document.getElementsByClassName('removeFeatureBtn');
            for(var i = 0; i < removeFeatureBtn.length; i++){
                var btn = removeFeatureBtn[i];
                btn.addEventListener('click', removeFeature);
            }
        }

        function removeFeature(event){
            var button = event.target;
            button.parentElement.parentElement.parentElement.remove();
        }

        function removeFeatureWithData(event){
            var button = event.target;
            var feature_id = button.parentElement.id;
            $.ajax({
                url: '/feature_id_remove',
                type: 'post',
                data: {
                    "feature_id":feature_id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                success: function(data){
                    button.parentElement.parentElement.parentElement.remove();
                },

            });
            //console.log(feature_id);
            // button.parentElement.parentElement.parentElement.remove();
        }
    }
