<?php
include_once '../../config.php';
include_once 'utils/RequestHelper.php';
include_once 'includes/header.php';
?>

<div class="jumbotron">
    <h1>Question Editor API</h1>
    <p>Our editor. Your item bank platform.<p>
    <div class="row">
        <div class="col-md-10">
            <h4><a href="http://docs.learnosity.com/questioneditorapi/" class="text-muted">
                <span class="glyphicon glyphicon-book"></span> Documentation
            </a></h4>
        </div>
        <div class="col-md-2"><p class='text-right'><a class="btn btn-primary btn-lg" href="../../reporting/reports/index.php">Next <span class="glyphicon glyphicon-chevron-right"></span></a></p></div>
    </div>
</div>

<!--
********************************************************************
*
* Nav for different Question Editor API examples
*
********************************************************************
-->
<div class="alert alert-info" id="example-description"></div>
<ul class="nav nav-tabs" id="nav-questioneditor">
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">New Question<b class="caret"></b></a>
        <ul class="dropdown-menu">
            <li><a href="#" data-type="newQuestion" id="newQuestion">Standard</a></li>
            <li><a href="#" data-type="tileUI" id="tileUI">Question type tiles (beta)</a></li>
            <li><a href="#" data-type="defaults" id="defaults">with defaults</a></li>
            <li><a href="#" data-type="disabled" id="disabled">with certain attributes disabled</a></li>
            <li><a href="#" data-type="defaultsdisabled" id="defaultsdisabled">with certain attributes disabled and defaults</a></li>
            <li><a href="#" data-type="defaultsdisabledgraphing" id="defaultsdisabledgraphing">with certain attributes disabled and defaults (Graphing)</a></li>
            <li><a href="#" data-type="assetuploadexample" id="assetupload">with image gallery asset handler</a></li>
        </ul>
    </li>
    <li><a href="#" data-type="edit" id="edit">Edit Existing Question</a></li>
    <li><a href="#" data-type="feedback" id="feedback">Rubric Feedback</a></li>
    <li><a href="#" data-type="features" id="features">Stimulus Features</a></li>
</ul>

<!-- Container for the question editor api to load into -->
<script src="//questioneditor.learnosity.com"></script>
<div class="learnosity-question-editor"></div>
<script>
    /********************************************************************
    *
    * Set the different initialisation settings based off the
    * example currently being requested
    *
    ********************************************************************/
    var initType,
        initObjects = {
            newQuestion: {
                description: 'Just the standard default editor with no defaults set or attributes disabled.',
                json: {
                    configuration: {
                        questionsApiVersion: 'v2'
                    },
                    widgetType: 'response',
                    ui: {
                        columns: [{
                            tabs: ['edit', 'advanced'],
                            width: '50%'
                        }, {
                            tabs: ['preview', 'layout'],
                            width: '50%'
                        }],
                        fixed_preview: {
                            margin_top: 50
                        }
                    }
                }
            },
            tileUI: {
                description: 'Question type tile thumbnails are templates of commonly used question configuration.',
                json: {
                    configuration: {
                        questionsApiVersion: 'v2'
                    },
                    widgestType: 'response',
                    ui: {
                        question_tiles: true
                    },
                    question_types: {
                        association: {
                            group_reference: "match"
                        },
                        audio: {
                            group_reference: "writespeak"
                        },
                        choicematrix: {},
                        classification: {
                            group_reference: "match"
                        },
                        clozeassociation: {
                            group_reference: "cloze"
                        },
                        clozedropdown: {
                            group_reference: "cloze"
                        },
                        clozeinlinetext: {
                            group_reference: "cloze"
                        },
                        clozetext: {
                            group_reference: "cloze"
                        },
                        formula: {
                            group_reference: "math"
                        },
                        graphplotting: {
                            group_reference: "math"
                        },
                        highlight: {},
                        imageclozeassociation: {
                            group_reference: "cloze"
                        },
                        imageclozedropdown: {
                            group_reference: "cloze"
                        },
                        imageclozetext: {
                            group_reference: "cloze"
                        },
                        longtext: {
                            group_reference: "writespeak"
                        },
                        mcq: {
                            name: "MCQ - Standard",
                            group_reference: "mcq"
                        },
                        numberline: {
                            group_reference: "math"
                        },
                        orderlist: {
                            group_reference: "ordersort"
                        },
                        plaintext: {
                            group_reference: "writespeak"
                        },
                        shorttext: {
                            group_reference: "writespeak"
                        },
                        sortlist: {
                            group_reference: "ordersort"
                        },
                        texthighlight: {
                            group_reference: "highlight"
                        },
                        tokenhighlight: {
                            group_reference: "highlight"
                        },
                        audioplayer: {},
                        counter: {},
                        imagetool: {},
                        calculator: {},
                        sharedpassage: {},
                        videoplayer: {}
                    },
                    question_type_templates: {
                        mcq: [{
                            name: "MCQ - Block Style",
                            group_reference: "mcq",
                            description: "Multiple Choice question with block style and predefined options.",
                            image: "img/mcq_block.png",
                            defaults: {
                                stimulus: "The <strong>student</strong> needs to say which of these are state capitals.",
                                options: [{
                                    label: "Dublin",
                                    value: "1"
                                }, {
                                    label: "Bristol",
                                    value: "2"
                                }, {
                                    label: "Liverpool",
                                    value: "3"
                                }, {
                                    label: "London",
                                    value: "4"
                                }],
                                ui_style: {
                                    type: "block",
                                    columns: 1,
                                    choice_label: "upper-alpha"
                                }
                            }
                        }, {
                            name: "MCQ - Horizontal",
                            group_reference: "mcq",
                            description: "Horizontal Multiple Choice question with predefined options.",
                            image: "img/mcq_horizontal.png",
                            defaults: {
                                instant_feedback: true,
                                options: [{
                                    value: "1",
                                    label: "Red"
                                }, {
                                    value: "2",
                                    label: "Violet"
                                }, {
                                    value: "3",
                                    label: "Blue"
                                }, {
                                    value: "4",
                                    label: "Orange"
                                }],
                                stimulus: "Which of these colours has the smallest wavelength?",
                                type: "mcq",
                                ui_style: {
                                    columns: 2,
                                    type: "horizontal"
                                },
                                valid_responses: [{
                                    value: "2",
                                    score: 1
                                }]
                            }
                        }, {
                            name: "MCQ - Multi Select",
                            group_reference: "mcq",
                            image: "img/mcq_multi.png",
                            defaults: {
                                stimulus: "Which of these cities are state capitals?",
                                options: [{
                                    label: "Wilmington, NC",
                                    value: "wilmington"
                                }, {
                                    label: "Trenton, NJ",
                                    value: "trenton"
                                }, {
                                    label: "Topeka, KS",
                                    value: "topeka"
                                }, {
                                    label: "St. Louis, MO",
                                    value: "stlouis"
                                }],
                                valid_responses: [{
                                    value: "trenton",
                                    score: "1"
                                }, {
                                    value: "topeka",
                                    score: "1"
                                }],
                                multiple_responses: true
                            }
                        }]
                    },
                    question_type_groups: [
                        {
                            reference: "mcq",
                            name: "Multiple Choice"
                        }, {
                            reference: "cloze",
                            name: "Cloze"
                        }, {
                            reference: "math",
                            name: "Math"
                        }, {
                            reference: "writespeak",
                            name: "Write and Speak"
                        }, {
                            reference: "highlight",
                            name: "Highlight"
                        }, {
                            reference: "match",
                            name: "Match Items"
                        }, {
                            reference: "ordersort",
                            name: "Order and Sort"
                        }
                    ],
                }
            },
            defaults: {
                description: 'In this example we\'re defaulting the editor to allow '
                    + 'editing of only one question type. We\'re also setting certain '
                    + 'attributes before the author sees it, like <em>instant_feedback</em> '
                    + 'being set to true, a default <em>Stimulus</em> being set etc.',
                json: {
                    configuration: {
                        questionsApiVersion: "v2"
                    },
                    question_types: {
                        association: {
                            defaults: {
                                "type": "association",
                                "feedback_attempts": 5,
                                "instant_feedback": true,
                                "stimulus": "<p>Question stimulus goes here.</p>",
                                "validation": {
                                    "partial_scoring": true,
                                    "penalty_score": -0.5,
                                    "valid_score": 1
                                    }
                            }
                        }
                    },
                    widgetType: 'response'
                }
            },
            disabled: {
                description: 'In this example we\'re hiding certain '
                + 'attributes to demonstrate the flexibility you can provide to authors.',
                json: {
                    configuration: {
                        questionsApiVersion: "v2"
                    },
                    question_types: {
                        clozetext: {
                            hidden: [
                                "character_map", "description", "feedback_attempts",
                                "instant_feedback", "is_math", "max_length",
                                "metadata", "response_container", "spellcheck", "stimulus_review"
                            ]
                        }
                    },
                    widgetType: 'response'
                }
            },
            defaultsdisabled: {
                description: 'In this example we\'re defaulting the editor to allow '
                + 'editing of only one question type. We\'re also hiding certain '
                + 'attributes to demonstrate the flexibility you can provide to authors.',
                json: {
                    configuration: {
                        questionsApiVersion: "v2"
                    },
                    question_types: {
                        clozeassociation: {
                            hidden: [ "description", "feedback_attempts", "instant_feedback",
                                "is_math", "max_length", "metadata", "response_container",
                                "spellcheck", "stimulus_review"
                            ],
                            defaults : {
                                possible_responses: ["Answer 1", "Answer 2"],
                                template: "<p>Here is a nice template of a Close Text question. It is nice and "
                                    + "easy to put a {{response}} in.</p><p>Here is another {{response}} container.</p>"
                            }
                        }
                    },
                    widgetType: 'response'
                }
            },
            defaultsdisabledgraphing: {
                description: 'In this example we\'re defaulting the editor to allow '
                + 'very simple templating of Graphing Questions. We\'re also hiding certain '
                + 'attributes to demonstrate the flexibility you can provide to authors.',
                json: {
                    configuration: {
                        questionsApiVersion: "v2"
                    },
                    widgetType: 'response',
                    question_types: {
                        graphplotting: {
                            hidden: [ "description", "feedback_attempts", "instant_feedback",
                                "is_math", "grid", "axis_x", "axis_y",
                                "draw_zero", "stimulus_review", "annotation", "mode","ui_style"
                            ],
                            defaults : {
                                annotation : {
                                    "label_right": "\\(X\\)",
                                    "label_top": "\\(Y\\)"
                                },
                                axis_x : {
                                    "draw_labels": true,
                                    "show_first_arrow": true,
                                    "show_last_arrow": true,
                                    "ticks_distance": 1
                                },
                                axis_y : {
                                    "draw_labels": true,
                                    "show_first_arrow": true,
                                    "show_last_arrow": true,
                                    "ticks_distance": 1
                                },
                                canvas : {
                                    "show_hover_position": true,
                                    "snap_to": "grid",
                                    "x_max": 10.5,
                                    "x_min": -10.5,
                                    "y_max": 10.5,
                                    "y_min": -10.5
                                } ,
                                draw_zero: true,
                                grid : {
                                    "x_distance": 1,
                                    "y_distance": 1
                                },
                                instant_feedback : true,
                                is_math : true,
                                stimulus : "Enter the question stimulus here.",
                                "validation": {
                                    "penalty_score": "0",
                                    "valid_responses": [],
                                    "valid_score": "1"
                                }
                            }
                        }
                    },
                ui: {
                        columns: [
                            {
                                tabs: ["edit", "advanced"],
                                width: "40%"
                            },
                            {
                                tabs: ["preview", "layout"],
                                width: "60%"
                            }
                        ],
                        fixed_preview: {
                            margin_top: 45
                        }
                    }
                }
            },
            assetuploadexample: {
                description: 'Example of the custom asset uploader.',
                json: {
                    configuration: {
                        questionsApiVersion: "v2"
                    },
                    widgetType: 'response',
                    question_types: {
                        imageclozeassociation: {
                            defaults: {
                                "img_src": "//upload.wikimedia.org/wikipedia/commons/5/5f/Sydney_1932.jpg",
                                "possible_responses": ["North Sydney", "Harbour Bridge", "The Rocks"],
                                "response_container": {"pointer": "left"},
                                "response_positions": [{
                                    "x": 45,
                                    "y": 42.47
                                    }, {
                                    "x": 12.22,
                                    "y": 64.2
                                    }, {
                                    "x": 45,
                                    "y": 24.94
                                    }]
                            }
                        }
                    },
                    assetRequest: function(mediaRequested, returnType, callback) {
                        if (mediaRequested === 'image') {
                            var $modal = $('.modal.img-upload'),
                                $images = $('.asset-img-gallery img'),
                                imgClickHandler = function () {
                                    if (returnType === 'HTML') {
                                        callback('<img src="' + $(this).data('img') + '"/>');
                                    } else {
                                        callback($(this).data('img'));
                                    }
                                    $modal.modal('hide');
                                };
                            $images.on('click', imgClickHandler);
                            $modal.modal({
                                backdrop: 'static'
                            }).on('hide', function () {
                                $images.off('click', imgClickHandler);
                            });
                        }
                    },
                    ui: {
                        columns: [
                            {
                                tabs: ["edit", "advanced"],
                                width: "50%"
                            },
                            {
                                tabs: ["preview", "layout"],
                                width: "50%"
                            }
                        ],
                        fixed_preview: {
                            margin_top: 45
                        }
                    }
                }
            },
            edit: {
                description: 'In this example we\'re editing a previously created question.',
                json: {
                    configuration: {
                        questionsApiVersion: "v2"
                    },
                    question_types : ["imageclozeassociation"],
                    widget_json: {
                        "type": "imageclozeassociation",
                        "img_src": "//www.learnosity.com/static/img/Blank_US_Map.png",
                        "possible_responses": ["Oregon", "California", "Texas", "Florida"],
                        "response_positions": [
                            {
                                "x": 71.25,
                                "y": 79.88
                            }, {
                                "x": 0,
                                "y": 15.68
                            }, {
                                "x": 35.53,
                                "y": 70.41
                            }, {
                                "x": 0,
                                "y": 44.08
                            }
                        ],
                        "validation": {
                            "partial_scoring": true,
                            "penalty_score": -0.5,
                            "valid_responses": [
                                ["Florida"],
                                ["Oregon"],
                                ["Texas"],
                                ["California"]
                            ],
                            "valid_score": 1
                        }
                    },
                    widgetType: 'response'
                }
            },
            feedback: {
                description: 'For teacher and grader feedback/rubrics. Default '
                    + 'editor with an existing rating feedback type.',
                json: {
                    configuration: {
                        questionsApiVersion: 'v2'
                    },
                    widget_json: {
                        'options': [
                            {
                                'value': '1',
                                'label': '25%',
                                'label_tooltip': 'Unsatisfactory',
                                'tint': 'red',
                                'description': 'Poor effort.'
                            },
                            {
                                'value': '2',
                                'label': '50%',
                                'label_tooltip': 'Average',
                                'tint': 'orange',
                                'description': 'You only just passed, more effort is required.'
                            },
                            {
                                'value': '3',
                                'label': '75%',
                                'label_tooltip': 'Credit',
                                'tint': 'blue',
                                'description': 'You responded well to all questions.'
                            },
                            {
                                'value': '4',
                                'label': '100%',
                                'label_tooltip': 'Perfect',
                                'tint': 'green',
                                'description': 'You answered everything correctly!'
                            }
                        ],
                        'type': 'rating'
                    },
                    widget_type: 'feedback'
                }
            },
            features: {
                description: 'Stimulus Features like Audio and Video. Default '
                    + 'editor with an existing video feature.',
                json: {
                    configuration: {
                        questionsApiVersion: "v2"
                    },
                    widget_json: {
                        "src": "//www.youtube.com/watch?feature=player_detailpage&amp;v=flL7M36QszA",
                        "type": "videoplayer"
                    },
                    widget_type: 'feature'
                }
            }
        };

    function changeExample(evt) {

        var type = $(this).attr('data-type');
        evt.preventDefault();
        $('#nav-questioneditor').find('li').removeClass('active');
        if ($(this).closest('ul').hasClass('dropdown-menu')) {
            $(this).closest('li.dropdown').addClass('active');
        } else {

            $(this).parent().addClass('active');
        }
        if (typeof type !== 'undefined') {
            window.location.hash = $(this).attr('id');
            currentType = initObjects[type];
            $('#example-description').html(currentType.description);
            LearnosityQuestionEditor.init(currentType.json);
        }
    }

    (function($) {
        $('#nav-questioneditor').find('a').on('click', changeExample);
        var hashString = window.location.hash;
        if(hashString !== "") {
            $(hashString).trigger('click');
        } else {
            $('#newQuestion').trigger('click');
        }
    }(jQuery));
</script>

<?php
    include_once 'views/modals/asset-upload.php';
    include_once 'includes/footer.php';
