/* ---------------------------------------------
 Hero Banner Block
--------------------------------------------- */    
( function( blocks, element, editor, components ) {
    // Necessary Module
    var el = element.createElement;
    var source = blocks.source;
    var RichText = wp.editor.RichText;
    var BlockControl = wp.editor.BlockControls;
    var AlignmentToolbars = wp.editor.AlignmentToolbar;
    var BlockAlignmentToolbars = wp.editor.BlockAlignmentToolbar;
    var MediaUploads = wp.editor.MediaUpload;
    var InspectorControl = wp.editor.InspectorControls;
    var ToggleControl = wp.components.ToggleControl;
    var ColorPalettes = wp.editor.ColorPalette;
    var PanelColorSetting = wp.editor.PanelColorSettings;
    var Dashicons = wp.components.Dashicon;
    var IconButtons = wp.components.IconButton;
    var URLInputs = wp.editor.URLInput;
    var validAlignments = [ 'wide', 'full' ];

    // Block Register
    blocks.registerBlockType( 'intrinsic-core/hero-banner', {
        title: wp.i18n.__('Hero Banner'),
        description: wp.i18n.__('Add a customizable Hero Banner.'),
        icon: 'money',
        category: 'intrinsic-blocks',
        getEditWrapperProps( attributes ) {
            var align = attributes.alignmentControl;
            if ( -1 !== validAlignments.indexOf( align ) ) {
                return { 'data-align': align };
            }
        },
        attributes: {
            alignmentControl: {
                type: 'string',
                default: 'full'
            },      
            horizontalBorder: {
                type: 'boolean',
                default: true
            },
            subheading: {
                type: 'array',
                source: 'children',
                selector: '.hero-subheading',
            },         
            authortitle: {
                type: 'array',
                source: 'children',
                selector: '.hero-title',
            },     
            firstdesegnation: {
                type: 'array',
                source: 'children',
                selector: '.hero-designation li:nth-child(1)',
            },         
            seconddesegnation: {
                type: 'array',
                source: 'children',
                selector: '.hero-designation li:nth-child(2)',
            },
            thirddesegnation: {
                type: 'array',
                source: 'children',
                selector: '.hero-designation li:nth-child(3)',
            },
            videobtntext: {
                type: 'string',
            },
            videourl: {
                type: 'string',
                source: 'attribute',
                selector: 'a',
                attribute: 'href',
            },
            mediaID: {
                type: 'number',
            },
            mediaURL: {
                type: 'string',
            }, 
            horizontalbordercolor: {
                type: 'string',
                default: '#aeaeae',
            },    
            subHeadings: {
                type: 'string',
                default: '#ffffff',
            },   
            authornamecolor: {
                type: 'string',
                default: '#ffffff',
            },
            buttonColor: {
                type: 'string',
                default: '#ffffff',
            },
            authordesegnationcolor: {
                type: 'string',
                default: '#e51681',
            },
        },
        edit: function( props ) {
            var onSelectImage = function( media ) {
                return props.setAttributes( {
                    mediaURL: media.url,
                    mediaID: media.id,
                } );
            };
            var onRemoveImage = function() {
                return props.setAttributes( {
                    mediaURL: null,
                    mediaID: null,
                } );
            };

            return [
                el(
                    InspectorControl, { key: 'inspector' },
                    el(
                        wp.components.PanelBody, {
                            title: wp.i18n.__( 'Content Settings' ),
                            className: 'block-profile-status-icons',
                            initialOpen: true,
                        },
                        el(
                           ToggleControl, {
                               label: wp.i18n.__( 'Enable/Disable Horizontal Border' ),
                               description:  wp.i18n.__( 'Enable/Disable Padding Horizontal Border' ),
                               checked: props.attributes.horizontalBorder,
                               onChange: function( value ) {
                                   props.setAttributes( { horizontalBorder: !props.attributes.horizontalBorder } );
                               },
                           }
                        ),
                        el( MediaUploads, {
                            onSelect: onSelectImage,
                            type: 'image',
                            value: props.attributes.mediaID,
                            render: function( obj ) {
                                return [
                                    el( wp.components.Button, {
                                        className: props.attributes.mediaID ? 'image-button' : 'editor-post-featured-image__toggle',
                                        modalClass: 'editor-post-featured-image__media-modal',
                                        onClick: obj.open
                                    }, !props.attributes.mediaID ? el( 'span', { className: 'no-image' }, wp.i18n.__('Select Background Image') ) : el( 'img', { src: props.attributes.mediaURL } ),
                                    ),
                                    props.attributes.mediaID && el( wp.components.Button, {
                                        className: 'is-link is-destructive',
                                        onClick: onRemoveImage
                                    }, wp.i18n.__('Remove Image') )
                                ];
                            }
                        })
                    ),
                    el(
                        PanelColorSetting, {
                            title: wp.i18n.__( 'Color Setting' ),
                            className: 'block-color-settings',
                            initialOpen: false,
                            colorSettings: [{
                                value: props.attributes.horizontalbordercolor,
                                onChange: function( value ) {
                                    props.setAttributes( { horizontalbordercolor: value } );
                                },
                                label: wp.i18n.__( 'Horizontal Border Color' ),
                            }, 
                            {
                                value: props.attributes.subHeadings,
                                onChange: function( value ) {
                                    props.setAttributes( { subHeadings: value } );
                                },
                                label: wp.i18n.__( 'Sub Headings Color' ),
                            },
                            {
                                value: props.attributes.authornamecolor,
                                onChange: function( value ) {
                                    props.setAttributes( { authornamecolor: value } );
                                },
                                label: wp.i18n.__( 'Author Name Color' ),
                            },
                            {
                                value: props.attributes.authordesegnationcolor,
                                onChange: function( value ) {
                                    props.setAttributes( { authordesegnationcolor: value } );
                                },
                                label: wp.i18n.__( 'Designation Color' ),
                            },
                            {
                                value: props.attributes.buttonColor,
                                onChange: function( value ) {
                                    props.setAttributes( { buttonColor: value } );
                                },
                                label: wp.i18n.__( 'Button Color' ),
                            }]
                        }
                    )
                ),
                el(
                    BlockControl, { key: 'controls' },
                    el( BlockAlignmentToolbars, {
                        value: props.attributes.alignmentControl,
                        onChange: function( value ) {
                            props.setAttributes({ alignmentControl: value });
                        },
                        controls: [ 'wide', 'full' ]
                    })
                ),
                el( 'div', { className: props.className }, 
                    el('div', { className: 'hero-block' },
                        el('div', { className: 'container-xl' },
                            el( 'div', { className: 'row' },
                                el( 'div', { className: 'col-md-9' },
                                    props.attributes.horizontalBorder && el( 'div', { className: 'horizontal-border', style: { backgroundColor: props.attributes.horizontalbordercolor } } ),
                                    el( RichText, {
                                        tagName: 'h2',
                                        className: 'hero-subheading',
                                        placeholder: wp.i18n.__( 'Add Sub Headings...' ),
                                        value: props.attributes.subheading,
                                        onChange: function( value ) {
                                            props.setAttributes({ subheading: value });
                                        },
                                        style: { color: props.attributes.subHeadings }
                                    } ),
                                    el( RichText, {
                                        tagName: 'h2',
                                        className: 'hero-title',
                                        placeholder: wp.i18n.__( 'Add Author Name...' ),
                                        value: props.attributes.authortitle,
                                        onChange: function( value ) {
                                            props.setAttributes({ authortitle: value });
                                        },
                                        style: { color: props.attributes.authornamecolor }
                                    } ),
                                    el( 'ul', { className: 'hero-designation' },
                                        el( RichText, {
                                            tagName: 'li',
                                            placeholder: wp.i18n.__( 'Add First Designation...' ),
                                            value: props.attributes.firstdesegnation,
                                            onChange: function( value ) {
                                                props.setAttributes({ firstdesegnation: value });
                                            },
                                            style: { color: props.attributes.authordesegnationcolor }
                                        } ),
                                        el( RichText, {
                                            tagName: 'li',
                                            placeholder: wp.i18n.__( 'Add Second Designation...' ),
                                            value: props.attributes.seconddesegnation,
                                            onChange: function( value ) {
                                                props.setAttributes({ seconddesegnation: value });
                                            },
                                            style: { color: props.attributes.authordesegnationcolor }
                                        } ),
                                        el( RichText, {
                                            tagName: 'li',
                                            placeholder: wp.i18n.__( 'Add Third Designation...' ),
                                            value: props.attributes.thirddesegnation,
                                            onChange: function( value ) {
                                                props.setAttributes({ thirddesegnation: value });
                                            },
                                            style: { color: props.attributes.authordesegnationcolor }
                                        } )
                                    ),
                                    el( RichText, {
                                        tagName: 'span',
                                        className: 'video-title',
                                        placeholder: wp.i18n.__( 'Add Button Text...' ),
                                        value: props.attributes.videobtntext,
                                        onChange: function( value ) {
                                            props.setAttributes({ videobtntext: value });
                                        },
                                        style: { color: props.attributes.buttonColor }
                                    } ),
                                    el( 'form', {
                                        key: 'form-link',
                                        className: 'blocks-button__inline-link',
                                        onSubmit: function( event ) {
                                            event.preventDefault();
                                        }
                                    }, el( Dashicons, {
                                        icon: 'admin-links',  
                                    }), el( URLInputs, {
                                        className: 'button-url',
                                        value: props.attributes.videourl,
                                        onChange: function( value ) {
                                            props.setAttributes({ videourl: value });
                                        }
                                    } ), el( IconButtons, {
                                       icon: 'editor-break',
                                       label: wp.i18n.__( 'label' ),
                                       type: 'submit'
                                    } ) )
                                )
                            )
                        ),
                        el('div', { className: 'hg-background' },
                            el( 'div', { 
                                className: 'hg-background-image',
                                style: { backgroundImage: 'url('+ props.attributes.mediaURL +')'  }
                            } )
                        )
                    )
                )
            ];
        },
        save: function( props ) {
            return el( 'div', { className: props.className +' align'+ props.attributes.alignmentControl }, 
                el('div', { className: 'hero-block' },
                    el( 'div', { className: 'container-xl' },
                        el( 'div', { className: 'row' },
                            el( 'div', { className: 'col-md-9' },
                                props.attributes.horizontalBorder && el( 'div', { className: 'horizontal-border', style: { backgroundColor: props.attributes.horizontalbordercolor } } ),
                                el( RichText.Content, {
                                    tagName: 'h2',
                                    className: 'hero-subheading',
                                    value: props.attributes.subheading,
                                    style: { color: props.attributes.subHeadings }
                                }),
                                el( RichText.Content, {
                                    tagName: 'h2',
                                    className: 'hero-title',
                                    value: props.attributes.authortitle,
                                    style: { color: props.attributes.authornamecolor }
                                }),
                                el( 'ul', { className: 'hero-designation' },
                                    el( RichText.Content, {
                                        tagName: 'li',
                                        value: props.attributes.firstdesegnation,
                                        style: { color: props.attributes.authordesegnationcolor }
                                    }),
                                    el( RichText.Content, {
                                        tagName: 'li',
                                        value: props.attributes.seconddesegnation,
                                        style: { color: props.attributes.authordesegnationcolor }
                                    }),
                                    el( RichText.Content, {
                                        tagName: 'li',
                                        value: props.attributes.thirddesegnation,
                                        style: { color: props.attributes.authordesegnationcolor }
                                    })
                                ),
                                el( 'a', { 
                                    className: 'hero-video-btn video-popup',
                                    href: props.attributes.videourl,
                                    style: { color: props.attributes.buttonColor }
                                    },
                                    el( 'i', { className: 'fas fa-play' } ),
                                    el( RichText.Content, {
                                        tagName: 'span',
                                        className: 'video-title',
                                        value: props.attributes.videobtntext
                                    }) 
                                )
                            )
                        )
                    ),
                    el( 'div', { className: 'hg-background' },
                        el( 'div', { 
                            className: 'hg-background-image',
                            style: { backgroundImage: 'url('+ props.attributes.mediaURL +')' }
                        } )
                    )
                )
            );
        }
    });
})(
    window.wp.blocks,
    window.wp.element
);

/* ---------------------------------------------
 Heading Block
--------------------------------------------- */ 
( function( blocks, element, editor, components ) {
    // Necessary Module
    var el = element.createElement;
    var source = blocks.source;
    var RichText = wp.editor.RichText;
    var BlockControl = wp.editor.BlockControls;
    var AlignmentToolbars = wp.editor.AlignmentToolbar;
    var InspectorControl = wp.editor.InspectorControls;
    var ToggleControl = wp.components.ToggleControl;
    var ColorPalettes = wp.editor.ColorPalette;
    var PanelColorSetting = wp.editor.PanelColorSettings;

    // Block Register
    blocks.registerBlockType( 'intrinsic-core/advance-headings', {
        title: wp.i18n.__('Advance Headings'),
        description: wp.i18n.__('Add a advance headings.'),
        icon: 'editor-bold',
        category: 'intrinsic-blocks',
        attributes: {
            alignmentControl: {
                type: 'string',
                default: 'center'
            },      
            countingTitle: {
                type: 'array',
                source: 'children',
                selector: '.title-counter',
            },         
            headings: {
                type: 'array',
                source: 'children',
                selector: '.title-main',
            },             
            countingColor: {
                type: 'string',
                default: '#e1e1e1',
            },    
            headingColor: {
                type: 'string',
                default: '#121212',
            },   
            smallBorderColor: {
                type: 'string',
                default: '#000000',
            },
            largeBorderColor: {
                type: 'string',
                default: '#e51681',
            },
            enabledCounting: {
                type: 'boolean',
                default: true
            },
            enabledBorderBottom: {
                type: 'boolean',
                default: true
            },
        },
        edit: function( props ) {
            return [
                el( InspectorControl, { key: 'inspector' },
                    el(
                        wp.components.PanelBody, {
                            title: wp.i18n.__( 'Content Settings' ),
                            className: 'block-headings-icons',
                            initialOpen: true,
                        },
                        el(
                           ToggleControl, {
                               label: wp.i18n.__( 'Enable/Disable Counting' ),
                               description:  wp.i18n.__( 'Enable/Disable counting with headers' ),
                               checked: props.attributes.enabledCounting,
                               onChange: function( value ) {
                                   props.setAttributes( { enabledCounting: !props.attributes.enabledCounting } );
                               },
                           }
                        ),
                        el(
                           ToggleControl, {
                               label: wp.i18n.__( 'Enable/Disable Border Bottom' ),
                               description:  wp.i18n.__( 'Enable/Disable border bottom in headers' ),
                               checked: props.attributes.enabledBorderBottom,
                               onChange: function( value ) {
                                   props.setAttributes( { enabledBorderBottom: !props.attributes.enabledBorderBottom } );
                               },
                           }
                        )
                    ),
                    el(
                        PanelColorSetting, {
                            title: wp.i18n.__( 'Color Setting' ),
                            className: 'block-color-settings',
                            initialOpen: false,
                            colorSettings: [{
                                value: props.attributes.countingColor,
                                onChange: function( value ) {
                                    props.setAttributes( { countingColor: value } );
                                },
                                label: wp.i18n.__( 'Counting Color' ),
                            }, 
                            {
                                value: props.attributes.headingColor,
                                onChange: function( value ) {
                                    props.setAttributes( { headingColor: value } );
                                },
                                label: wp.i18n.__( 'Heading Color' ),
                            },
                            {
                                value: props.attributes.smallBorderColor,
                                onChange: function( value ) {
                                    props.setAttributes( { smallBorderColor: value } );
                                },
                                label: wp.i18n.__( 'Small Border Color' ),
                            },
                            {
                                value: props.attributes.largeBorderColor,
                                onChange: function( value ) {
                                    props.setAttributes( { largeBorderColor: value } );
                                },
                                label: wp.i18n.__( 'Large Border Color' ),
                            }]
                        }
                    )
                ),
                el(
                    BlockControl, { key: 'controls' },
                    el( AlignmentToolbars, {
                        value: props.attributes.alignmentControl,
                        onChange: function( value ) {
                            props.setAttributes({ alignmentControl: value });
                        },
                        controls: [ 'left', 'center', 'right' ]
                    })
                ),
                el( 'div', { className: props.className },
                    el( 'div', { className: 'section-title', style: { textAlign: props.attributes.alignmentControl } },
                        props.attributes.enabledCounting && el( RichText, {
                            tagName: 'h2',
                            className: 'title-counter',
                            value: props.attributes.countingTitle,
                            placeholder: wp.i18n.__( 'Add Counting...' ),
                            onChange: function( value ) {
                                props.setAttributes( { countingTitle: value } );
                            },
                            style: { color: props.attributes.countingColor }
                        }),
                        el( RichText, {
                            tagName: 'h2',
                            className: 'title-main',
                            value: props.attributes.headings,
                            placeholder: wp.i18n.__( 'Add Headings...' ),
                            onChange: function( value ) {
                                props.setAttributes({ headings: value });
                            },
                            style: { color: props.attributes.headingColor }
                        }),
                        props.attributes.enabledBorderBottom && el( 'div', { className: 'title-border', style: { textAlign: props.attributes.alignmentControl } },
                            el( 'span', { className: 'small-border bg-black', style: { backgroundColor: props.attributes.smallBorderColor } } ),
                            el( 'span', { className: 'large-border bg-deep-cerise', style: { backgroundColor: props.attributes.largeBorderColor } } ),
                            el( 'span', { className: 'small-border bg-black', style: { backgroundColor: props.attributes.smallBorderColor } } )
                        )
                    )
                )
            ];
        },
        save: function( props ) {
            return(
                el( 'div', { className: props.className },
                    el( 'div', { className: 'section-title', style: { textAlign: props.attributes.alignmentControl } },
                        props.attributes.enabledCounting && el( RichText.Content, {
                            tagName: 'h2',
                            className: 'title-counter',
                            value: props.attributes.countingTitle,
                            style: { color: props.attributes.countingColor }
                        }),
                        el( RichText.Content, {
                            tagName: 'h2',
                            className: 'title-main',
                            value: props.attributes.headings,
                            style: { color: props.attributes.headingColor }
                        }),
                        props.attributes.enabledBorderBottom && el( 'div', { className: 'title-border', style: { textAlign: props.attributes.alignmentControl } },
                            el( 'span', { className: 'small-border bg-black', style: { backgroundColor: props.attributes.smallBorderColor } } ),
                            el( 'span', { className: 'large-border bg-deep-cerise', style: { backgroundColor: props.attributes.largeBorderColor } } ),
                            el( 'span', { className: 'small-border bg-black', style: { backgroundColor: props.attributes.smallBorderColor } } )
                        )
                    )
                )
            );
        }
    });

})(
    window.wp.blocks,
    window.wp.element
);

/* ---------------------------------------------
 Service Block
--------------------------------------------- */
( function( blocks, element, editor, components ) {
    // Necessary Module
    var el = element.createElement;
    var source = blocks.source;
    var RichText = wp.editor.RichText;
    var PlainText = wp.editor.PlainText;
    var BlockControl = wp.editor.BlockControls;
    var AlignmentToolbars = wp.editor.AlignmentToolbar;
    var InspectorControl = wp.editor.InspectorControls;
    var ToggleControl = wp.components.ToggleControl;
    var ColorPalettes = wp.editor.ColorPalette;
    var PanelColorSetting = wp.editor.PanelColorSettings;
    var TextAreaControls = wp.components.TextareaControl;
    var SelectControl = wp.components.SelectControl;

    // Make consumable Array
    function _toConsumableArray(arr) { 
        if (Array.isArray(arr)) {
            for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) {
                arr2[i] = arr[i]; 
            } 
            return arr2; 
        } else { 
            return Array.from(arr); 
        } 
    }

    // Block Register
    blocks.registerBlockType( 'intrinsic-core/service-items', {
        title: wp.i18n.__('Service'),
        description: wp.i18n.__('Add a service box.'),
        icon: 'media-default',
        category: 'intrinsic-blocks',
        attributes: {
            alignmentControl: {
                type: 'string',
                default: 'center'
            },
            id: {
                source: 'attribute',
                selector: '.item-id',
                attribute: 'id'
            },
            services: {
                type: 'array',
                default: [],
                source: 'query',
                selector: '.service-block-content',
                query: {
                    seriveIcons: {
                        source: 'attribute',
                        selector: '.service-icon i',
                        attribute: 'class'
                    },  
                    index: {
                        source: 'text',
                        selector: '.service-index'
                    },
                    serviceTitle: {
                        source: 'text',
                        selector: '.service-title',
                    },
                    content: {
                        source: 'text',
                        selector: '.service-content p'
                    },
                }
            },            
            iconColor: {
                type: 'string',
                default: '#e51681',
            },    
            titleColor: {
                type: 'string',
                default: '#ffffff',
            },   
            listColor: {
                type: 'string',
                default: '#c3c3c3',
            },
            backgroundColor: {
                type: 'string',
                default: '#27282b',
            }, 
            serviceStyle: {
                type: 'string',
                default: 'grid',
            },
        },
        edit: function( props ) {
            var services = props.attributes.services;

            if( !props.attributes.id ) {
                var id = 'service' + Math.floor(Math.random() * 100);
                props.setAttributes({
                    id: id
                });
            }

            var serviceList = services.sort(function(a,b) {
                return a.index - b.index;
            }).map( function( service ) {
                return( 
                    el( 'div', { className: 'service-blocks' },
                        el('p', {},
                            el( 'span', { className: 'service-index' }, 'Insert Service Item Here:' ),
                            el( 'span', {
                                className: 'remove-service',
                                onClick: function() {
                                    var newService = services.filter( function( item ) {
                                        return item.index != service.index;
                                    } ).map( function(t) {
                                        if( t.index > service.index ) {
                                            t.index -= 1;
                                        }
                                        return t;
                                    } );
                                    props.setAttributes({ services: newService });
                                }
                            }, el( 'i', { className: 'fa fa-times' } ) )
                        ),
                        el( 'div', { className: 'service-editor-content', style: { backgroundColor: props.attributes.backgroundColor } },
                            el( PlainText, {
                                className: 'service-icon-code',
                                placeholder: wp.i18n.__( 'Icon Code' ),
                                value: service.seriveIcons,
                                onChange: function( icon ) {
                                    var newIcon = Object.assign({}, service, {
                                        seriveIcons: icon
                                    });
                                    props.setAttributes({
                                        services: [].concat( _toConsumableArray( services.filter( function( item ) {
                                            return item.index != service.index;
                                        } ) ), [newIcon] )
                                    });
                                },
                                style: { color: props.attributes.iconColor }
                            }),
                            el( PlainText, {
                                className: 'service-title',
                                placeholder: wp.i18n.__( 'Add Service Title..' ),
                                value: service.serviceTitle,
                                onChange: function( title ) {
                                    var newTitle = Object.assign({}, service, {
                                        serviceTitle: title
                                    });
                                    props.setAttributes({
                                        services: [].concat( _toConsumableArray( services.filter( function( item ) {
                                            return item.index != service.index;
                                        } ) ), [newTitle] )
                                    });
                                },
                                style: { color: props.attributes.titleColor }
                            } ),
                            el( PlainText, {
                                className: 'service-content',
                                placeholder: wp.i18n.__( 'Add Service Description..' ),
                                value: service.content,
                                onChange: function( contents ) {
                                    var newContent = Object.assign({}, service, {
                                        content: contents,
                                    });
                                    props.setAttributes({
                                        services: [].concat( _toConsumableArray( services.filter( function( item ) {
                                            return item.index != service.index;
                                        } ) ), [ newContent ] )
                                    });
                                },
                                style: { color: props.attributes.listColor }
                            } )
                        )
                    )
                );
            } );

            return [
                el( InspectorControl, { key: 'inspector' },
                    el(
                        wp.components.PanelBody, {
                            title: wp.i18n.__( 'Content Settings' ),
                            className: 'block-headings-icons',
                            initialOpen: true,
                        },
                        el( SelectControl, {
                            label: wp.i18n.__( 'Select Service Style' ),
                            value: props.attributes.serviceStyle,
                            options: [
                                { value: 'grid', label: wp.i18n.__( 'Grid' ) },
                                { value: 'carousel', label: wp.i18n.__( 'Carousel' ) },
                            ],
                            onChange: function( value ) {
                                props.setAttributes({ serviceStyle: value });
                            }
                        } )
                    ),
                    el(
                        PanelColorSetting, {
                            title: wp.i18n.__( 'Color Setting' ),
                            className: 'block-color-settings',
                            initialOpen: false,
                            colorSettings: [{
                                value: props.attributes.iconColor,
                                onChange: function( value ) {
                                    props.setAttributes( { iconColor: value } );
                                },
                                label: wp.i18n.__( 'Icon Color' ),
                            }, 
                            {
                                value: props.attributes.titleColor,
                                onChange: function( value ) {
                                    props.setAttributes( { titleColor: value } );
                                },
                                label: wp.i18n.__( 'Title Color' ),
                            },
                            {
                                value: props.attributes.listColor,
                                onChange: function( value ) {
                                    props.setAttributes( { listColor: value } );
                                },
                                label: wp.i18n.__( 'Description Color' ),
                            },
                            {
                                value: props.attributes.backgroundColor,
                                onChange: function( value ) {
                                    props.setAttributes( { backgroundColor: value } );
                                },
                                label: wp.i18n.__( 'Background Color' ),
                            }]
                        }
                    )
                ),
                el( 'div', { className: props.className },
                    serviceList,
                    el( 'button', {
                        className: 'add-more-service',
                        onClick: function( content ) {
                            return props.setAttributes({
                                services: [].concat( _toConsumableArray( props.attributes.services ), [{
                                    index: props.attributes.services.length,
                                    content: '',
                                    seriveIcons: '',
                                    serviceTitle: ''
                                }] )
                            });
                        }
                    }, '+' )
                )
            ];
        },
        save: function( props ) {
            var services = props.attributes.services;
            return(
                el( 'div', { className: props.className, },
                    el( 'div', { className: 'service-block-content-item' },
                        props.attributes.serviceStyle == 'grid' && el('div', {
                            className: 'row'
                        }, services.map( function( service ) {
                                return el( 'div', { className: 'item col-md-6 col-lg-4', key: service.index },
                                    el('div', { className: 'service-block-content' },
                                        el( 'div', { className: 'service-card mrb-30', style: { backgroundColor: props.attributes.backgroundColor } }, 
                                            el( 'span', { className: 'service-index', style: { display: 'none' } }, service.index ),
                                            el( 'div', { className: 'service-icon' }, 
                                                el( 'i', { className: service.seriveIcons, style: { color: props.attributes.iconColor } } ) 
                                            ),
                                            el( 'h2', { className: 'service-title', style: { color: props.attributes.titleColor } }, service.serviceTitle ),
                                            el( 'div', { className: 'service-content', style: { color: props.attributes.listColor } },
                                                el( 'p', {}, service.content )
                                            ),
                                            el('div', { className: 'shadow-icon service-icon' },
                                                el( 'i', { className: service.seriveIcons } ) 
                                            )
                                        )
                                    )
                                )
                            } )
                        ),
                        props.attributes.serviceStyle == 'carousel' && el('div', {
                            className: 'service-carousel owl-carousel',
                            'data-owl-items': '3',
                            'data-owl-margin': '30',
                            'data-owl-dots': '1',
                            'data-animate': 'hg-fadeInUp'
                        }, services.map( function( service ) {
                                return el( 'div', { className: 'item', key: service.index },
                                    el('div', { className: 'service-block-content' },
                                        el( 'div', { className: 'service-card mrb-30', style: { backgroundColor: props.attributes.backgroundColor } }, 
                                            el( 'span', { className: 'service-index', style: { display: 'none' } }, service.index ),
                                            el( 'div', { className: 'service-icon' }, 
                                                el( 'i', { className: service.seriveIcons, style: { color: props.attributes.iconColor } } ) 
                                            ),
                                            el( 'h2', { className: 'service-title', style: { color: props.attributes.titleColor } }, service.serviceTitle ),
                                            el( 'div', { className: 'service-content', style: { color: props.attributes.listColor } },
                                                el( 'p', {}, service.content )
                                            ),
                                            el('div', { className: 'shadow-icon service-icon' },
                                                el( 'i', { className: service.seriveIcons } ) 
                                            )
                                        )
                                    )
                                )
                            } )
                        )
                    )
                )
            );
        }
    });
})(
    window.wp.blocks,
    window.wp.element
);

/* ---------------------------------------------
 Progress Bar
--------------------------------------------- */
( function( blocks, element, editor, components ) {
    // Necessary Module
    var el = element.createElement;
    var source = blocks.source;
    var RichText = wp.editor.RichText;
    var BlockControl = wp.editor.BlockControls;
    var AlignmentToolbars = wp.editor.AlignmentToolbar;
    var InspectorControl = wp.editor.InspectorControls;
    var ToggleControl = wp.components.ToggleControl;
    var ColorPalettes = wp.editor.ColorPalette;
    var PanelColorSetting = wp.editor.PanelColorSettings;
    var TextAreaControls = wp.components.TextareaControl;
    var RangeControls = wp.components.RangeControl;


    // Block Register
    blocks.registerBlockType( 'intrinsic-core/progressbar-items', {
        title: wp.i18n.__('Progress Bar'),
        description: wp.i18n.__('Add a Progress bar.'),
        icon: 'editor-alignleft',
        category: 'intrinsic-blocks',
        attributes: {     
            progressTitle: {
                type: 'array',
                source: 'children',
                selector: '.progress-title',
            },     
            progressStatus: {
                type: 'number',
                default: 75,
            },                
            titleColor: {
                type: 'string',
                default: '#121212',
            },   
            outerBg: {
                type: 'string',
                default: '#fafafa',
            },
            innerBg: {
                type: 'string',
                default: '#e51681',
            },
        },
        edit: function( props ) {
            return [
                el( InspectorControl, { key: 'inspector' },
                    el(
                        wp.components.PanelBody, {
                            title: wp.i18n.__( 'Content Settings' ),
                            className: 'block-headings-icons',
                            initialOpen: true,
                        },
                        el(
                            RangeControls, {
                                label: wp.i18n.__( 'Progress Status (%)' ),
                                value: props.attributes.progressStatus,
                                onChange: function( value ) {
                                    props.setAttributes( { progressStatus: value } );
                                },
                                min: 0,
                                max: 100,
                                step: 1,
                            }
                        ),
                    ),
                    el(
                        PanelColorSetting, {
                            title: wp.i18n.__( 'Color Setting' ),
                            className: 'block-color-settings',
                            initialOpen: false,
                            colorSettings: [{
                                value: props.attributes.titleColor,
                                onChange: function( value ) {
                                    props.setAttributes( { titleColor: value } );
                                },
                                label: wp.i18n.__( 'Title And Percentage Color' ),
                            },
                            {
                                value: props.attributes.outerBg,
                                onChange: function( value ) {
                                    props.setAttributes( { outerBg: value } );
                                },
                                label: wp.i18n.__( 'Outer Background Color' ),
                            },
                            {
                                value: props.attributes.innerBg,
                                onChange: function( value ) {
                                    props.setAttributes( { innerBg: value } );
                                },
                                label: wp.i18n.__( 'Inner Background Color' ),
                            }]
                        }
                    )
                ),
                el( 'div', { className: props.className },
                    el( 'div', { className: 'skill-progress' },
                        el( 'div', { className: 'skill-bar', 'data-percentage': props.attributes.progressStatus + '%', },
                            el( 'h4', { className: 'progress-title-holder' },
                                el( RichText, {
                                    tagName: 'span',
                                    className: 'progress-title',
                                    value: props.attributes.progressTitle,
                                    onChange: function( value ) {
                                        props.setAttributes({ progressTitle: value });
                                    },
                                    placeholder: wp.i18n.__( 'Add Progress Title..' ),
                                    style: { color: props.attributes.titleColor }
                                } ),
                                el( 'span', { className: 'progress-wrapper' },
                                    el( 'span', { className: 'progress-mark', style: { left: props.attributes.progressStatus + '%' } },
                                        el( 'span', { className: 'percent', style: { color: props.attributes.titleColor } }, props.attributes.progressStatus + '%' )
                                    )
                                )
                            ),
                            el( 'div', { className: 'progress-outter', style: { backgroundColor: props.attributes.outerBg } },
                                el( 'div', { className: 'progress-content', style: { width: props.attributes.progressStatus + '%', backgroundColor: props.attributes.innerBg  } } )
                            )
                        )
                    )
                )
            ];
        },
        save: function( props ) {
            return(
                el( 'div', { className: props.className },
                    el( 'div', { className: 'skill-progress' },
                        el( 'div', { className: 'skill-bar', 'data-percentage': props.attributes.progressStatus + '%', },
                            el( 'h4', { className: 'progress-title-holder' },
                                el( RichText.Content, {
                                    tagName: 'span',
                                    className: 'progress-title',
                                    value: props.attributes.progressTitle,
                                    style: { color: props.attributes.titleColor }
                                } ),
                                el( 'span', { className: 'progress-wrapper' },
                                    el( 'span', { className: 'progress-mark' },
                                        el( 'span', { className: 'percent', style: { color: props.attributes.titleColor } }, props.attributes.progressStatus + '%' )
                                    )
                                )
                            ),
                            el( 'div', { className: 'progress-outter', style: { backgroundColor: props.attributes.outerBg } }, 
                                el( 'div', { className: 'progress-content', style: { backgroundColor: props.attributes.innerBg } } )
                            )
                        )
                    )
                )
            );
        }
    });
})(
    window.wp.blocks,
    window.wp.element
);

/* ---------------------------------------------
 Counter Items
--------------------------------------------- */
( function( blocks, element, editor, components ) {
    // Necessary Module
    var el = element.createElement;
    var source = blocks.source;
    var RichText = wp.editor.RichText;
    var BlockControl = wp.editor.BlockControls;
    var AlignmentToolbars = wp.editor.AlignmentToolbar;
    var BlockAlignmentToolbars = wp.editor.BlockAlignmentToolbar;
    var InspectorControl = wp.editor.InspectorControls;
    var ToggleControl = wp.components.ToggleControl;
    var ColorPalettes = wp.editor.ColorPalette;
    var PanelColorSetting = wp.editor.PanelColorSettings;
    var TextControls = wp.components.TextControl;
    var TextAreaControls = wp.components.TextareaControl;
    var RangeControls = wp.components.RangeControl;

    var validAlignments = [ 'center' , 'wide', 'full' ];

    // Block Register
    blocks.registerBlockType( 'intrinsic-core/counter-items', {
        title: wp.i18n.__('Counter Bar'),
        description: wp.i18n.__('Add a counter bar.'),
        icon: 'admin-settings',
        category: 'intrinsic-blocks',
        getEditWrapperProps( attributes ) {
            var align = attributes.alignmentControl;
            if ( -1 !== validAlignments.indexOf( align ) ) {
                return { 'data-align': align };
            }
        },
        attributes: { 
            alignmentControl: {
                type: 'string',
                default: 'full'
            },       
            firstCounterTitle: {
                type: 'string',
                default: 'Happy Client',
            },     
            firstProgressStatus: {
                type: 'string',
                default: '117',
            },           
            secondCounterTitle: {
                type: 'string',
                default: 'Years Experience',
            },     
            secondProgressStatus: {
                type: 'string',
                default: '20',
            },  
            thirdCounterTitle: {
                type: 'string',
                default: 'Award Winer',
            },     
            thirdProgressStatus: {
                type: 'string',
                default: '16',
            }, 
            fourthCounterTitle: {
                type: 'string',
                default: 'Project Complete',
            },     
            fourthProgressStatus: {
                type: 'string',
                default: '156',
            },
            spacingTop: {
                type: 'number',
                default: 235,
            },
            spacingBottom: {
                type: 'number',
                default: 120,
            },                
            titleColor: {
                type: 'string',
                default: '#121212',
            },   
            progressBarBg: {
                type: 'string',
                default: '#12141c',
            },
            progressColor: {
                type: 'string',
                default: '#ffffff',
            },
        },
        edit: function( props ) {
            return [
                el( InspectorControl, { key: 'inspector' },
                    el(
                        wp.components.PanelBody, {
                            title: wp.i18n.__( 'Content Settings' ),
                            className: 'block-counter-icons',
                            initialOpen: true,
                        },
                        el( TextControls, {
                            label: wp.i18n.__( 'First Counting Number' ),
                            value: props.attributes.firstProgressStatus,
                            onChange: function( value ) {
                                props.setAttributes({ firstProgressStatus: value });
                            }
                        } ),
                        el( TextControls, {
                            label: wp.i18n.__( 'First Counting Title' ),
                            value: props.attributes.firstCounterTitle,
                            onChange: function( value ) {
                                props.setAttributes({ firstCounterTitle: value });
                            }
                        } ),
                        el( TextControls, {
                            label: wp.i18n.__( 'Second Counting Number' ),
                            value: props.attributes.secondProgressStatus,
                            onChange: function( value ) {
                                props.setAttributes({ secondProgressStatus: value });
                            }
                        } ),
                        el( TextControls, {
                            label: wp.i18n.__( 'Second Counting Title' ),
                            value: props.attributes.secondCounterTitle,
                            onChange: function( value ) {
                                props.setAttributes({ secondCounterTitle: value });
                            }
                        } ),
                        el( TextControls, {
                            label: wp.i18n.__( 'Third Counting Number' ),
                            value: props.attributes.thirdProgressStatus,
                            onChange: function( value ) {
                                props.setAttributes({ thirdProgressStatus: value });
                            }
                        } ),
                        el( TextControls, {
                            label: wp.i18n.__( 'Third Counting Title' ),
                            value: props.attributes.thirdCounterTitle,
                            onChange: function( value ) {
                                props.setAttributes({ thirdCounterTitle: value });
                            }
                        } ),
                        el( TextControls, {
                            label: wp.i18n.__( 'Fourth Counting Number' ),
                            value: props.attributes.fourthProgressStatus,
                            onChange: function( value ) {
                                props.setAttributes({ fourthProgressStatus: value });
                            }
                        } ),
                        el( TextControls, {
                            label: wp.i18n.__( 'Fourth Counting Title' ),
                            value: props.attributes.fourthCounterTitle,
                            onChange: function( value ) {
                                props.setAttributes({ fourthCounterTitle: value });
                            }
                        } )
                    ),
                    el(
                        wp.components.PanelBody, {
                            title: wp.i18n.__( 'Spacing Settings' ),
                            className: 'block-counter-icons',
                            initialOpen: false,
                        },
                        el(
                            RangeControls, {
                                label: wp.i18n.__( 'Spacing Top' ),
                                value: props.attributes.spacingTop,
                                onChange: function( value ) {
                                    props.setAttributes( { spacingTop: value } );
                                },
                                min: 0,
                                max: 500,
                                step: 1,
                            }
                        ),
                        el(
                            RangeControls, {
                                label: wp.i18n.__( 'Spacing Bottom' ),
                                value: props.attributes.spacingBottom,
                                onChange: function( value ) {
                                    props.setAttributes( { spacingBottom: value } );
                                },
                                min: 0,
                                max: 500,
                                step: 1,
                            }
                        ),
                    ),
                    el(
                        PanelColorSetting, {
                            title: wp.i18n.__( 'Color Setting' ),
                            className: 'block-color-settings',
                            initialOpen: false,
                            colorSettings: [{
                                value: props.attributes.progressBarBg,
                                onChange: function( value ) {
                                    props.setAttributes( { progressBarBg: value } );
                                },
                                label: wp.i18n.__( 'Progress Background Color' ),
                            },
                            {
                                value: props.attributes.progressColor,
                                onChange: function( value ) {
                                    props.setAttributes( { progressColor: value } );
                                },
                                label: wp.i18n.__( 'Progress Text Color' ),
                            }]
                        }
                    )
                ),
                el(
                    BlockControl, { key: 'controls' },
                    el( BlockAlignmentToolbars, {
                        value: props.attributes.alignmentControl,
                        onChange: function( value ) {
                            props.setAttributes({ alignmentControl: value });
                        },
                        controls: [ 'center', 'wide', 'full' ]
                    })
                ),
                el( 'div', { className: props.className +' align'+ props.attributes.alignmentControl, style: { backgroundColor: props.attributes.progressBarBg, paddingTop: props.attributes.spacingTop, paddingBottom: props.attributes.spacingBottom } },
                    el( 'div', { className: 'fun-facts-block' },
                        el( 'div', { className: 'container hg-promo-numbers' },
                            el( 'div', { className: 'row' },
                                el( 'div', { className: 'col-sm-6 col-lg-3' },
                                    el( 'div', { className: 'tg-promo-number text-center' },
                                        el( 'div', { className: 'odometer', 'data-odometer-final': props.attributes.firstProgressStatus, style: { color: props.attributes.progressColor }  }, props.attributes.firstProgressStatus ),
                                        el( 'h4', { className: 'promo-title', style: { color: props.attributes.progressColor } }, props.attributes.firstCounterTitle )
                                    )
                                ),
                                el( 'div', { className: 'col-sm-6 col-lg-3' },
                                    el( 'div', { className: 'tg-promo-number text-center' },
                                        el( 'div', { className: 'odometer', 'data-odometer-final': props.attributes.secondProgressStatus, style: { color: props.attributes.progressColor }  }, props.attributes.secondProgressStatus ),
                                        el( 'h4', { className: 'promo-title', style: { color: props.attributes.progressColor } }, props.attributes.secondCounterTitle )
                                    )
                                ),
                                el( 'div', { className: 'col-sm-6 col-lg-3' },
                                    el( 'div', { className: 'tg-promo-number text-center' },
                                        el( 'div', { className: 'odometer', 'data-odometer-final': props.attributes.thirdProgressStatus, style: { color: props.attributes.progressColor }  }, props.attributes.thirdProgressStatus ),
                                        el( 'h4', { className: 'promo-title', style: { color: props.attributes.progressColor } }, props.attributes.thirdCounterTitle )
                                    )
                                ),
                                el( 'div', { className: 'col-sm-6 col-lg-3' },
                                    el( 'div', { className: 'tg-promo-number text-center' },
                                        el( 'div', { className: 'odometer', 'data-odometer-final': props.attributes.fourthProgressStatus, style: { color: props.attributes.progressColor }  }, props.attributes.fourthProgressStatus ),
                                        el( 'h4', { className: 'promo-title', style: { color: props.attributes.progressColor } }, props.attributes.fourthCounterTitle )
                                    )
                                )
                            )
                        )
                    )
                )
            ];
        },
        save: function( props ) {
            return(
                el( 'div', { className: props.className +' align'+ props.attributes.alignmentControl, style: { backgroundColor: props.attributes.progressBarBg, paddingTop: props.attributes.spacingTop, paddingBottom: props.attributes.spacingBottom } },
                    el( 'div', { className: 'fun-facts-block' },
                        el( 'div', { className: 'container hg-promo-numbers' },
                            el( 'div', { className: 'row' },
                                el( 'div', { className: 'col-sm-6 col-lg-3' },
                                    el( 'div', { className: 'tg-promo-number text-center' },
                                        el( 'div', { className: 'odometer', 'data-odometer-final': props.attributes.firstProgressStatus, style: { color: props.attributes.progressColor }  }, props.attributes.firstProgressStatus ),
                                        el( 'h4', { className: 'promo-title', style: { color: props.attributes.progressColor } }, props.attributes.firstCounterTitle )
                                    )
                                ),
                                el( 'div', { className: 'col-sm-6 col-lg-3' },
                                    el( 'div', { className: 'tg-promo-number text-center' },
                                        el( 'div', { className: 'odometer', 'data-odometer-final': props.attributes.secondProgressStatus, style: { color: props.attributes.progressColor }  }, props.attributes.secondProgressStatus ),
                                        el( 'h4', { className: 'promo-title', style: { color: props.attributes.progressColor } }, props.attributes.secondCounterTitle )
                                    )
                                ),
                                el( 'div', { className: 'col-sm-6 col-lg-3' },
                                    el( 'div', { className: 'tg-promo-number text-center' },
                                        el( 'div', { className: 'odometer', 'data-odometer-final': props.attributes.thirdProgressStatus, style: { color: props.attributes.progressColor }  }, props.attributes.thirdProgressStatus ),
                                        el( 'h4', { className: 'promo-title', style: { color: props.attributes.progressColor } }, props.attributes.thirdCounterTitle )
                                    )
                                ),
                                el( 'div', { className: 'col-sm-6 col-lg-3' },
                                    el( 'div', { className: 'tg-promo-number text-center' },
                                        el( 'div', { className: 'odometer', 'data-odometer-final': props.attributes.fourthProgressStatus, style: { color: props.attributes.progressColor }  }, props.attributes.fourthProgressStatus ),
                                        el( 'h4', { className: 'promo-title', style: { color: props.attributes.progressColor } }, props.attributes.fourthCounterTitle )
                                    )
                                )
                            )
                        )
                    )
                )
            );
        }
    });
})(
    window.wp.blocks,
    window.wp.element
);

/* ---------------------------------------------
 Call To Actions
--------------------------------------------- */
( function( blocks, element, editor, components ) {
    // Necessary Module
    var el = element.createElement;
    var source = blocks.source;
    var RichText = wp.editor.RichText;
    var BlockControl = wp.editor.BlockControls;
    var AlignmentToolbars = wp.editor.AlignmentToolbar;
    var BlockAlignmentToolbars = wp.editor.BlockAlignmentToolbar;
    var MediaUploads = wp.editor.MediaUpload;
    var InspectorControl = wp.editor.InspectorControls;
    var ToggleControl = wp.components.ToggleControl;
    var ColorPalettes = wp.editor.ColorPalette;
    var PanelColorSetting = wp.editor.PanelColorSettings;
    var TextControls = wp.components.TextControl;
    var TextAreaControls = wp.components.TextareaControl;
    var RangeControls = wp.components.RangeControl;
    var Dashicons = wp.components.Dashicon;
    var IconButtons = wp.components.IconButton;
    var URLInputs = wp.editor.URLInput;

    var validAlignments = [ 'center' , 'wide', 'full' ];

    // Block Register
    blocks.registerBlockType( 'intrinsic-core/call-to-action', {
        title: wp.i18n.__('Call To Actions'),
        description: wp.i18n.__('Add a call to action.'),
        icon: 'editor-insertmore',
        category: 'intrinsic-blocks',
        getEditWrapperProps( attributes ) {
            var align = attributes.alignmentControl;
            if ( -1 !== validAlignments.indexOf( align ) ) {
                return { 'data-align': align };
            }
        },
        attributes: { 
            alignmentControl: {
                type: 'string',
                default: 'full'
            },
            calltotitle: {
                type: 'array',
                source: 'children',
                selector: '.call-to-title',
            }, 
            caltoobtntext: {
                type: 'array',
                source: 'children',
                selector: '.btn-call-to-text',
            },
            calltobtnUrl: {
                type: 'string',
                source: 'attribute',
                selector: 'a',
                attribute: 'href',
            },
            mediaID: {
                type: 'number',
            },
            mediaURL: {
                type: 'string',
            },                      
            spacingTop: {
                type: 'number',
                default: 105,
            },
            spacingBottom: {
                type: 'number',
                default: 120,
            },                
            titleColor: {
                type: 'string',
                default: '#ffffff',
            },   
            buttonBg: {
                type: 'string',
                default: '#e51681',
            },
            overlayColor: {
                type: 'string',
                default: 'rgba(18, 20, 28, 0.75)',
            },
        },
        edit: function( props ) {
            var onSelectImage = function( media ) {
                return props.setAttributes( {
                    mediaURL: media.url,
                    mediaID: media.id,
                } );
            };
            var onRemoveImage = function() {
                return props.setAttributes( {
                    mediaURL: null,
                    mediaID: null,
                } );
            };

            return [
                el( InspectorControl, { key: 'inspector' },
                    el(
                        wp.components.PanelBody, {
                            title: wp.i18n.__( 'Content Settings' ),
                            className: 'block-counter-icons',
                            initialOpen: true,
                        },
                        el( MediaUploads, {
                            onSelect: onSelectImage,
                            type: 'image',
                            value: props.attributes.mediaID,
                            render: function( obj ) {
                                return [
                                    el( wp.components.Button, {
                                        className: props.attributes.mediaID ? 'image-button' : 'editor-post-featured-image__toggle',
                                        modalClass: 'editor-post-featured-image__media-modal',
                                        onClick: obj.open
                                    }, !props.attributes.mediaID ? el( 'span', { className: 'no-image' }, wp.i18n.__('Select Background Image') ) : el( 'img', { src: props.attributes.mediaURL } ),
                                    ),
                                    props.attributes.mediaID && el( wp.components.Button, {
                                        className: 'is-link is-destructive',
                                        onClick: onRemoveImage
                                    }, wp.i18n.__('Remove Image') )
                                ];
                            }
                        })
                    ),
                    el(
                        wp.components.PanelBody, {
                            title: wp.i18n.__( 'Spacing Settings' ),
                            className: 'block-counter-icons',
                            initialOpen: false,
                        },
                        el(
                            RangeControls, {
                                label: wp.i18n.__( 'Spacing Top' ),
                                value: props.attributes.spacingTop,
                                onChange: function( value ) {
                                    props.setAttributes( { spacingTop: value } );
                                },
                                min: 0,
                                max: 500,
                                step: 1,
                            }
                        ),
                        el(
                            RangeControls, {
                                label: wp.i18n.__( 'Spacing Bottom' ),
                                value: props.attributes.spacingBottom,
                                onChange: function( value ) {
                                    props.setAttributes( { spacingBottom: value } );
                                },
                                min: 0,
                                max: 500,
                                step: 1,
                            }
                        ),
                    ),
                    el(
                        PanelColorSetting, {
                            title: wp.i18n.__( 'Color Setting' ),
                            className: 'block-color-settings',
                            initialOpen: false,
                            colorSettings: [{
                                value: props.attributes.titleColor,
                                onChange: function( value ) {
                                    props.setAttributes( { titleColor: value } );
                                },
                                label: wp.i18n.__( 'Title Color' ),
                            },
                            {
                                value: props.attributes.buttonBg,
                                onChange: function( value ) {
                                    props.setAttributes( { buttonBg: value } );
                                },
                                label: wp.i18n.__( 'Button Background' ),
                            },
                            {
                                value: props.attributes.overlayColor,
                                onChange: function( value ) {
                                    props.setAttributes( { overlayColor: value } );
                                },
                                label: wp.i18n.__( 'Overlay Color' ),
                            }]
                        }
                    )
                ),
                el(
                    BlockControl, { key: 'controls' },
                    el( BlockAlignmentToolbars, {
                        value: props.attributes.alignmentControl,
                        onChange: function( value ) {
                            props.setAttributes({ alignmentControl: value });
                        },
                        controls: [ 'center', 'wide', 'full' ]
                    })
                ),
                el( 'div', { className: props.className +' align'+ props.attributes.alignmentControl },
                    el( 'div', { className: 'call-to-action', style: { paddingTop: props.attributes.spacingTop, paddingBottom: props.attributes.spacingBottom } },
                        el( 'div', { className: 'container' },
                            el( RichText, {
                                tagName: 'h2',
                                className: 'call-to-title',
                                value: props.attributes.calltotitle,
                                placeholder: wp.i18n.__( 'Add Call To Action Title...' ),
                                onChange: function( value ) {
                                    props.setAttributes({ calltotitle: value });
                                },
                                style: { color: props.attributes.titleColor }
                            } ),
                            el( RichText, {
                                tagName: 'span',
                                className: 'btn-call-to-text',
                                placeholder: wp.i18n.__( 'Add Button Text...' ),
                                value: props.attributes.caltoobtntext,
                                onChange: function( value ) {
                                    props.setAttributes({ caltoobtntext: value });
                                },
                                style: { color: props.attributes.buttonBg }
                            } ),
                            el( 'form', {
                                key: 'form-link',
                                className: 'blocks-button__inline-link',
                                onSubmit: function( event ) {
                                    event.preventDefault();
                                }
                            }, el( Dashicons, {
                                icon: 'admin-links',  
                            }), el( URLInputs, {
                                className: 'button-url',
                                value: props.attributes.calltobtnUrl,
                                onChange: function( value ) {
                                    props.setAttributes({ calltobtnUrl: value });
                                }
                            } ), el( IconButtons, {
                               icon: 'editor-break',
                               label: wp.i18n.__( 'label' ),
                               type: 'submit'
                            } ) )
                        ),
                        el( 'div', { 
                            className: 'hg-background hg-overlay',
                            'data-bg-parallax': 'scroll',
                            'data-bg-parallax-speed': '3', 
                            style: { backgroundColor: props.attributes.overlayColor }
                        },
                            el( 'div', { 
                                className: 'hg-background-image hg-parallax-element',
                                style: { backgroundImage: 'url('+ props.attributes.mediaURL +')' }
                            } )
                        )
                    )
                )
            ];
        },
        save: function( props ) {
            return(
                el( 'div', { className: props.className +' align'+ props.attributes.alignmentControl },
                    el( 'div', { className: 'call-to-action', style: { paddingTop: props.attributes.spacingTop, paddingBottom: props.attributes.spacingBottom } },
                        el( 'div', { className: 'container' },
                            el( RichText.Content, {
                                tagName: 'h2',
                                className: 'call-to-title',
                                value: props.attributes.calltotitle,
                                style: { color: props.attributes.titleColor }
                            } ),
                            el( 'a', { 
                                className: 'btn btn-call-to mrt-30',
                                href: props.attributes.calltobtnUrl,
                                style: { backgroundColor: props.attributes.buttonBg }
                                },
                                el( RichText.Content, {
                                    tagName: 'span',
                                    className: 'btn-call-to-text',
                                    value: props.attributes.caltoobtntext
                                }) 
                            )
                        ),
                        el( 'div', { 
                            className: 'hg-background hg-overlay',
                            'data-bg-parallax': 'scroll',
                            'data-bg-parallax-speed': '3', 
                            style: { backgroundColor: props.attributes.overlayColor }
                        },
                            el( 'div', { 
                                className: 'hg-background-image hg-parallax-element',
                                style: { backgroundImage: 'url('+ props.attributes.mediaURL +')' }
                            } )
                        )
                    )
                )
            );
        }
    });
})(
    window.wp.blocks,
    window.wp.element
);

/* ---------------------------------------------
 Portfolio Blocks
--------------------------------------------- */
( function( blocks, element, editor, components ) {
    // Necessary Module
    var el = element.createElement;
    var source = blocks.source;
    var RichText = wp.editor.RichText;
    var BlockControl = wp.editor.BlockControls;
    var AlignmentToolbars = wp.editor.AlignmentToolbar;
    var BlockAlignmentToolbars = wp.editor.BlockAlignmentToolbar;
    var MediaUploads = wp.editor.MediaUpload;
    var InspectorControl = wp.editor.InspectorControls;
    var ToggleControl = wp.components.ToggleControl;
    var ColorPalettes = wp.editor.ColorPalette;
    var PanelColorSetting = wp.editor.PanelColorSettings;
    var TextControls = wp.components.TextControl;
    var TextAreaControls = wp.components.TextareaControl;
    var RangeControls = wp.components.RangeControl;
    var Fragment = wp.element.Fragment;
    var withSelect = wp.data.withSelect;
    var QueryControl = wp.components.QueryControls;
    var Placeholder = wp.components.Placeholder;
    var Spinner = wp.components.Spinner;
    var decodeEntities = wp.htmlEntities.decodeEntities;
    var SelectControl = wp.components.SelectControl;

    // Extends Module
    var _extends = Object.assign || function (target) { 
        for (var i = 1; i < arguments.length; i++) { 
            var source = arguments[i]; 
            for (var key in source) { 
                if (Object.prototype.hasOwnProperty.call(source, key)) { 
                    target[key] = source[key]; 
                } 
            } 
        } 
        return target; 
    };

    // Alignment Controls
    var validAlignments = [ 'center' , 'wide', 'full' ];

    // Block Register
    blocks.registerBlockType( 'intrinsic-core/portfolio', {
        title: wp.i18n.__('Portfolio'),
        description: wp.i18n.__('Add portfolio.'),
        icon: 'layout',
        category: 'intrinsic-blocks',
        getEditWrapperProps( attributes ) {
            var align = attributes.alignmentControl;
            if ( -1 !== validAlignments.indexOf( align ) ) {
                return { 'data-align': align };
            }
        },
        edit: withSelect( function( select, props ) {
            var latestPortfolioQuery = {
                order: props.attributes.order,
                orderby: props.attributes.orderBy,
                per_page: props.attributes.postsToShow
            };

            return {
                portfolios: select( 'core' ).getEntityRecords( 'postType', 'portfolio', latestPortfolioQuery ),
            }
        } )( function( props ) {

            if ( Array.isArray( props.portfolios ) !== false && props.portfolios.length > 0 ) {
                var portfolioItem = props.portfolios;
            } else {
                var portfolioItem = [];
            }

            var displayPortfolio = portfolioItem.length > props.attributes.postsToShow ? props.portfolios.slice( 0, props.attributes.postsToShow ) : portfolioItem;

            var hasPortfolio = Array.isArray( props.portfolios ) && props.portfolios.length;

            if( props.attributes.columns == 'one' ) {
                var columns_class = 'col-md-12 col-lg-12';
            } else if( props.attributes.columns == 'two' ) {
                var columns_class = 'col-md-6 col-lg-6 item';
            } else if( props.attributes.columns == 'three' ) {
                var columns_class = 'col-md-6 col-lg-4 item';
            } else {
                var columns_class = 'col-md-6 col-lg-3 item';
            }

            return [
                el( Fragment, {},
                    el( InspectorControl, { key: 'inspector' },
                        el(
                            wp.components.PanelBody, {
                                title: wp.i18n.__( 'Content Settings' ),
                                className: 'block-counter-icons',
                                initialOpen: true,
                            },
                            el( SelectControl, {
                                label: wp.i18n.__( 'Grid Layout' ),
                                value: props.attributes.columns,
                                options: [
                                    { value: 'one', label: wp.i18n.__( 'One Column' ) },
                                    { value: 'two', label: wp.i18n.__( 'Two Column' ) },
                                    { value: 'three', label: wp.i18n.__( 'Three Column' ) },
                                    { value: 'four', label: wp.i18n.__( 'Four Column' ) },
                                ],
                                onChange: function( value ) {
                                    props.setAttributes({ columns: value });
                                }
                            } ),
                            el( SelectControl, {
                                label: wp.i18n.__( 'Portfolio Open' ),
                                value: props.attributes.portfolioOpen,
                                options: [
                                    { value: 'popup', label: wp.i18n.__( 'Popup' ) },
                                    { value: 'single', label: wp.i18n.__( 'Single Portfolio' ) },
                                    { value: 'custom', label: wp.i18n.__( 'Custom Links' ) },
                                ],
                                onChange: function( value ) {
                                    props.setAttributes({ portfolioOpen: value });
                                }
                            } ),
                            el( QueryControl, _extends({ 
                                order: props.attributes.order,
                                orderBy: props.attributes.orderBy,
                                numberOfItems: props.attributes.postsToShow,
                            }, {
                                onOrderChange: function( value ) {
                                    return props.setAttributes({ order: value });
                                },  
                                onOrderByChange: function( value ) {
                                    return props.setAttributes({ orderBy: value });
                                }, 
                                onNumberOfItemsChange: function( value ) {
                                    return props.setAttributes({ postsToShow: value });
                                }
                            }) )
                        ),
                        el(
                            PanelColorSetting, {
                                title: wp.i18n.__( 'Color Setting' ),
                                className: 'block-color-settings',
                                initialOpen: false,
                                colorSettings: [{
                                    value: props.attributes.iconColor,
                                    onChange: function( value ) {
                                        props.setAttributes( { iconColor: value } );
                                    },
                                    label: wp.i18n.__( 'Icons Color' ),
                                },
                                {
                                    value: props.attributes.titleColor,
                                    onChange: function( value ) {
                                        props.setAttributes( { titleColor: value } );
                                    },
                                    label: wp.i18n.__( 'Title Background' ),
                                },
                                {
                                    value: props.attributes.cateColor,
                                    onChange: function( value ) {
                                        props.setAttributes( { cateColor: value } );
                                    },
                                    label: wp.i18n.__( 'Category Color' ),
                                },
                                {
                                    value: props.attributes.overlayColor,
                                    onChange: function( value ) {
                                        props.setAttributes( { overlayColor: value } );
                                    },
                                    label: wp.i18n.__( 'Overlay Color' ),
                                }]
                            }
                        )
                    ),
                    el(
                        BlockControl, { key: 'controls' },
                        el( BlockAlignmentToolbars, {
                            value: props.attributes.alignmentControl,
                            onChange: function( value ) {
                                props.setAttributes({ alignmentControl: value });
                            },
                            controls: [ 'center', 'wide', 'full' ]
                        })
                    ),
                    el( 'div', { className: props.className },
                        ! hasPortfolio && el( Placeholder, {
                            icon: 'admin-post',
                            label: wp.i18n.__( 'Intrinsic Portfolio Block' ),
                        }, ! Array.isArray( props.portfolios ) ? el( Spinner ) : wp.i18n.__( 'No Portfolio Found' ) ),
                        el( 'div', { className: 'row portfolio-grid' },
                            displayPortfolio.map( function( item, i ) {
                                if( props.attributes.portfolioOpen == 'custom' ) {
                                    var permalink = item.portfolio_custom;
                                    var classlink = 'custom-link';
                                } else if( props.attributes.portfolioOpen == 'popup' ) {
                                    var permalink = item.featured_image;
                                    var classlink = 'popup-image';
                                } else {
                                    var permalink = item.link;
                                    var classlink = 'single-link';
                                }
                                return el( 'div', {
                                        className: columns_class,
                                        key: i
                                    }, el( 'div', {
                                        className: 'portfolio-item',
                                        'data-animate': 'hg-fadeInUp',
                                    }, el( 'figure', { className: 'portfolio-thumb' },
                                            el( 'img', {
                                                src: item.featured_image,
                                                alt: decodeEntities( item.title.rendered.trim() || wp.i18n.__( '(Untitled Title)' ) )
                                            } ),
                                            el( 'div', { className: 'overlay-wrapper' },
                                                el( 'div', { className: 'overlay' } ),
                                                el( 'div', { className: 'popup' },
                                                    el( 'div', { className: 'popup-inner' },
                                                        el( 'a', {
                                                            href: permalink,
                                                            className: classlink
                                                        }, el( 'i', { className: 'fa fa-search', style: { color: props.attributes.iconColor } } ) )
                                                    )
                                                )
                                            )
                                        ),
                                        el( 'div', { className: 'content' },
                                            el( 'h3', { style: { color: props.attributes.titleColor } },
                                                el( 'a', { className: classlink, href: permalink  },
                                                    decodeEntities( item.title.rendered.trim() ) || wp.i18n.__( '(Untitled Title)' )
                                                )
                                            )
                                        ) 
                                    ) 
                                )
                            } )
                        )
                    )
                )
            ];
        } ),
        save: function( props ) {
            // Rendering in PHP
            return null;
        }
    });
})(
    window.wp.blocks,
    window.wp.element
);

/* ---------------------------------------------
 Blog Blocks
--------------------------------------------- */
( function( blocks, element, editor, components ) {
    // Necessary Module
    var el = element.createElement;
    var source = blocks.source;
    var RichText = wp.editor.RichText;
    var BlockControl = wp.editor.BlockControls;
    var AlignmentToolbars = wp.editor.AlignmentToolbar;
    var BlockAlignmentToolbars = wp.editor.BlockAlignmentToolbar;
    var MediaUploads = wp.editor.MediaUpload;
    var InspectorControl = wp.editor.InspectorControls;
    var ToggleControl = wp.components.ToggleControl;
    var ColorPalettes = wp.editor.ColorPalette;
    var PanelColorSetting = wp.editor.PanelColorSettings;
    var TextControls = wp.components.TextControl;
    var TextAreaControls = wp.components.TextareaControl;
    var RangeControls = wp.components.RangeControl;
    var Fragment = wp.element.Fragment;
    var withSelect = wp.data.withSelect;
    var QueryControl = wp.components.QueryControls;
    var Placeholder = wp.components.Placeholder;
    var Spinner = wp.components.Spinner;
    var decodeEntities = wp.htmlEntities.decodeEntities;
    var SelectControl = wp.components.SelectControl;

    // Extends Module
    var _extends = Object.assign || function (target) { 
        for (var i = 1; i < arguments.length; i++) { 
            var source = arguments[i]; 
            for (var key in source) { 
                if (Object.prototype.hasOwnProperty.call(source, key)) { 
                    target[key] = source[key]; 
                } 
            } 
        } 
        return target; 
    };

    // Alignment Controls
    var validAlignments = [ 'center' , 'wide', 'full' ];

    // Block Register
    blocks.registerBlockType( 'intrinsic-core/blog', {
        title: wp.i18n.__('Blog'),
        description: wp.i18n.__('Add blog grid.'),
        icon: 'grid-view',
        category: 'intrinsic-blocks',
        getEditWrapperProps( attributes ) {
            var align = attributes.alignmentControl;
            if ( -1 !== validAlignments.indexOf( align ) ) {
                return { 'data-align': align };
            }
        },
        edit: withSelect( function( select, props ) {
            var latestBlogQuery = {
                order: props.attributes.order,
                orderby: props.attributes.orderBy,
                per_page: props.attributes.postsToShow
            };

            return {
                posts: select( 'core' ).getEntityRecords( 'postType', 'post', latestBlogQuery ),
            }
        } )( function( props ) {

            if ( Array.isArray( props.posts ) !== false && props.posts.length > 0 ) {
                var postsItem = props.posts;
            } else {
                var postsItem = [];
            }

            var displayPosts = postsItem.length > props.attributes.postsToShow ? props.posts.slice( 0, props.attributes.postsToShow ) : postsItem;

            var hasPosts = Array.isArray( props.posts ) && props.posts.length;

            return [
                el( Fragment, {},
                    el( InspectorControl, { key: 'inspector' },
                        el(
                            wp.components.PanelBody, {
                                title: wp.i18n.__( 'Content Settings' ),
                                className: 'block-counter-icons',
                                initialOpen: true,
                            },
                            el( QueryControl, _extends({ 
                                order: props.attributes.order,
                                orderBy: props.attributes.orderBy,
                                numberOfItems: props.attributes.postsToShow,
                            }, {
                                onOrderChange: function( value ) {
                                    return props.setAttributes({ order: value });
                                },  
                                onOrderByChange: function( value ) {
                                    return props.setAttributes({ orderBy: value });
                                }, 
                                onNumberOfItemsChange: function( value ) {
                                    return props.setAttributes({ postsToShow: value });
                                }
                            }) )
                        ),
                        el(
                            PanelColorSetting, {
                                title: wp.i18n.__( 'Color Setting' ),
                                className: 'block-color-settings',
                                initialOpen: false,
                                colorSettings: [{
                                    value: props.attributes.titleColor,
                                    onChange: function( value ) {
                                        props.setAttributes( { titleColor: value } );
                                    },
                                    label: wp.i18n.__( 'Title Background' ),
                                },
                                {
                                    value: props.attributes.dateBg,
                                    onChange: function( value ) {
                                        props.setAttributes( { dateBg: value } );
                                    },
                                    label: wp.i18n.__( 'Date Background' ),
                                },
                                {
                                    value: props.attributes.dateColor,
                                    onChange: function( value ) {
                                        props.setAttributes( { dateColor: value } );
                                    },
                                    label: wp.i18n.__( 'Date Color' ),
                                },
                                {
                                    value: props.attributes.cateColor,
                                    onChange: function( value ) {
                                        props.setAttributes( { cateColor: value } );
                                    },
                                    label: wp.i18n.__( 'Category Color' ),
                                }]
                            }
                        )
                    ),
                    el(
                        BlockControl, { key: 'controls' },
                        el( BlockAlignmentToolbars, {
                            value: props.attributes.alignmentControl,
                            onChange: function( value ) {
                                props.setAttributes({ alignmentControl: value });
                            },
                            controls: [ 'center', 'wide', 'full' ]
                        })
                    ),
                    el( 'div', { className: props.className },
                        ! hasPosts && el( Placeholder, {
                            icon: 'admin-post',
                            label: wp.i18n.__( 'Intrinsic Block Block' ),
                        }, ! Array.isArray( props.posts ) ? el( Spinner ) : wp.i18n.__( 'No Blog Posts Found' ) ),
                        el( 'div', { className: 'row blog-grid' },
                            displayPosts.map( function( item, i ) {
                                return el( 'div', {
                                        className: 'col-md-4',
                                        key: i
                                    }, el( 'div', {
                                        className: 'post-item',
                                        'data-animate': 'hg-fadeInUp',
                                    }, el( 'article', { className: 'post' },
                                        el( 'figure', { className: 'post-thumb' },
                                            el( 'div', { className: 'entry-date' }, decodeEntities( item.post_date )  ),
                                            el( 'a', { href: item.link },
                                                el( 'img', {
                                                    src: item.featured_image,
                                                    alt: decodeEntities( item.title.rendered.trim() || wp.i18n.__( '(Untitled Title)' ) )
                                                } )
                                            )
                                        ),
                                        el( 'div', { className: 'post-detail' },
                                            el( 'h2', { className: 'entry-title', style: { color: props.attributes.titleColor } },
                                                el( 'a', { href: item.link }, decodeEntities( item.title.rendered.trim() || wp.i18n.__( '(Untitled Title)' ) ) )
                                            ),
                                            el( 'div', { className: 'entry-cat', style: { color: props.attributes.cateColor } },
                                                item.post_category.map( function( cat, j ) {
                                                    return el( 'span', { key: j },
                                                        decodeEntities( cat.cat_name )
                                                    )
                                                } )
                                            )
                                        )
                                    ) ) 
                                )
                            } )
                        )
                    )
                )
            ];
        } ),
        save: function( props ) {
            // Rendering in PHP
            return null;
        }
    });
})(
    window.wp.blocks,
    window.wp.element
);
/* ---------------------------------------------
 Contact Form
--------------------------------------------- */
( function( blocks, element, editor, components ) {
    // Necessary Module
    var el = element.createElement;
    var source = blocks.source;
    var RichText = wp.editor.RichText;
    var BlockControl = wp.editor.BlockControls;
    var AlignmentToolbars = wp.editor.AlignmentToolbar;
    var BlockAlignmentToolbars = wp.editor.BlockAlignmentToolbar;
    var MediaUploads = wp.editor.MediaUpload;
    var InspectorControl = wp.editor.InspectorControls;
    var ToggleControl = wp.components.ToggleControl;
    var ColorPalettes = wp.editor.ColorPalette;
    var PanelColorSetting = wp.editor.PanelColorSettings;
    var SelectControl = wp.components.SelectControl;

    // Block Register
    blocks.registerBlockType( 'intrinsic-core/contact-form', {
        title: wp.i18n.__('Contact Form 7'),
        description: wp.i18n.__('Add a contact form 7.'),
        icon: 'forms',
        category: 'intrinsic-blocks',
        attributes: { 
            form_id: {
                type: 'string'
            }
        },
        edit: function( props ) {

            props.attributes.form_id =  props.attributes.form_id &&  props.attributes.form_id != '0' ?  props.attributes.form_id : false;

            var contactFormList = [];
            for (var obj in intrinsic_contact_form_7_parmas.forms) {
                contactFormList.push( { value: obj, label: intrinsic_contact_form_7_parmas.forms[obj] } );
            }

            return [
                el( InspectorControl, { key: 'inspector' },
                    el(
                        wp.components.PanelBody, {
                            title: wp.i18n.__( 'Content Settings' ),
                            className: 'block-contact-form',
                            initialOpen: true,
                        },
                        el( SelectControl, {
                            label: wp.i18n.__( 'Select Contact Form 7' ),
                            value: props.attributes.form_id ? parseInt(props.attributes.form_id) : 0,
                            instanceID: 'intrinsic-contact-form-7-selector',
                            options: contactFormList,
                            onChange: function( value ) {
                                props.setAttributes({ form_id: value });
                            }
                        } )
                    )
                ),
                el( 'div', { className: props.className },
                    props.attributes.form_id ? wp.i18n.__( 'Contact Form Name : ' ) + intrinsic_contact_form_7_parmas.forms[props.attributes.form_id] : wp.i18n.__( 'Choose Your Form' )
                )
            ];
        },
        save: function( props ) {
            return(
                el( 'div', { className: props.className  },
                    props.attributes.form_id
                )
            );
        }
    });
})(
    window.wp.blocks,
    window.wp.element
);

/* ---------------------------------------------
 Testimonials
--------------------------------------------- */
( function( blocks, element, editor, components ) {
    // Necessary Module
    var el = element.createElement;
    var source = blocks.source;
    var RichText = wp.editor.RichText;
    var PlainText = wp.editor.PlainText;
    var BlockControl = wp.editor.BlockControls;
    var AlignmentToolbars = wp.editor.AlignmentToolbar;
    var BlockAlignmentToolbars = wp.editor.BlockAlignmentToolbar;
    var MediaUploads = wp.editor.MediaUpload;
    var InspectorControl = wp.editor.InspectorControls;
    var ToggleControl = wp.components.ToggleControl;
    var ColorPalettes = wp.editor.ColorPalette;
    var PanelColorSetting = wp.editor.PanelColorSettings;
    var SelectControl = wp.components.SelectControl;

    // Make consumable Array
    function _toConsumableArray(arr) { 
        if (Array.isArray(arr)) {
            for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) {
                arr2[i] = arr[i]; 
            } 
            return arr2; 
        } else { 
            return Array.from(arr); 
        } 
    }

    // Block Register
    blocks.registerBlockType( 'intrinsic-core/testimonial', {
        title: wp.i18n.__('Testimonial'),
        description: wp.i18n.__('Add a testimonial.'),
        icon: 'format-quote',
        category: 'intrinsic-blocks',
        attributes: { 
            id: {
                source: 'attribute',
                selector: '.carousel.slide',
                attribute: 'id'
            },
            testimonials: {
                type: 'array',
                default: [],
                source: 'query',
                selector: '.client-testimonial',
                query: {
                    image: {
                        source: "attribute",
                        selector: ".client-thumb img",
                        attribute: "src"
                    },
                    index: {
                        source: 'text',
                        selector: '.testimonial-index'
                    },
                    content: {
                        source: 'text',
                        selector: '.testimonial-text'
                    },
                    author: {
                        source: 'text',
                        selector: '.client-name'
                    }
                }
            },
            authorColor: {
                type: 'string',
                default: '#ffffff',
            },             
            quoteColor: {
                type: 'string',
                default: '#ffffff',
            },            
            testimonialBg: {
                type: 'string',
                default: '#27282b',
            }
        },
        edit: function( props ) {
            var testimonials = props.attributes.testimonials;

            if (!props.attributes.id) {
                var id = "testimonial" + Math.floor(Math.random() * 100);
                props.setAttributes({
                    id: id
                });
            }

            var testimonialList = testimonials.sort(function(a, b) {
                return a.index - b.index;
            }).map( function( testimonial ) { 
                return (
                    el( 'div', { className: 'testimonial-block' },
                        el( 'p', {}, 
                            el( 'span', { className: 'testimonial-index' }, 'Insert Testimonial Here: ' ),
                            el( 'span', { 
                                className: 'remove-testimonial',
                                onClick: function() {
                                    var newTestimonial = testimonials.filter( function( item ) {
                                        return item.index != testimonial.index;
                                    } ).map( function( t ) {
                                        if( t.index > testimonial.index ) {
                                            t.index -= 1; 
                                        }
                                        return t;
                                    });
                                    props.setAttributes( { testimonials: newTestimonial } );
                                }
                            }, el( 'i', { className: 'fa fa-times' } ) )
                        ),
                        el( 'blockquote', { className: 'wp-block-quote', style: { backgroundColor: props.attributes.testimonialBg } },
                            el( 'div', { className: 'testimonial_top_block' },
                                el( 'div', { className: 'author_image_block' },
                                    el( MediaUploads, {
                                        onSelect: function( media ) {
                                            var image = media.sizes.medium ? media.sizes.media.url : media.url;
                                            var newObject = Object.assign({}, testimonial, {
                                                image: image
                                            });
                                            props.setAttributes({ 
                                                testimonials: [].concat( _toConsumableArray( testimonials.filter( function( item ) {
                                                    return item.index != testimonial.index; 
                                                } ) ), [newObject] )
                                            });
                                        },
                                        type: 'image',
                                        value: testimonial.image,
                                        render: function render( _ref ) {
                                            var open = _ref.open;
                                            return !!testimonial.image ? el( 'div', {}, props.isSelected && el( 'div', {
                                                className: 'author_image_action'
                                            }, el( 'a', {
                                                href: '#',
                                                onClick: function() {
                                                    var newObject = Object.assign( {}, testimonial, {
                                                        image: null
                                                    } );
                                                    props.setAttributes({
                                                      testimonials: [].concat(_toConsumableArray(testimonials.filter(function (item) {
                                                        return item.index != testimonial.index;
                                                      })), [newObject])
                                                    });
                                                }
                                            }, wp.i18n.__( '\xD7 Remove' )
                                            ) ),
                                                el( 'div', { 
                                                    className: 'testimonial_author_image',
                                                    style: {
                                                        backgroundImage: "url(" + testimonial.image + ")"
                                                    },
                                                    onClick: open
                                                } )
                                            ) : el( 'a', {
                                                href: '#',
                                                className: 'testimonial_author_image',
                                                onClick: open
                                            }, wp.i18n.__( 'Select Image' ) )
                                        }
                                    } )
                                ),
                                el( 'div', {
                                    className: 'col-9 mt-3'
                                },
                                    el( PlainText, {
                                        className: 'author-plain-text',
                                        placeholder: wp.i18n.__( 'Author' ),
                                        value: testimonial.author,
                                        onChange: function onChange(author) {
                                            var newObject = Object.assign({}, testimonial, {
                                                author: author
                                            });
                                            props.setAttributes({
                                                testimonials: [].concat( _toConsumableArray(testimonials.filter(function(item) {
                                                    return item.index != testimonial.index;
                                                })), [newObject] )
                                            });
                                        },
                                        style: { color: props.attributes.authorColor }
                                    } )
                                )
                            ),
                            el( PlainText, {
                                className: 'content-plain-text',
                                style: { height: 58 },
                                placeholder: wp.i18n.__( 'Testimonial Text' ),
                                value: testimonial.content,
                                autoFocus: true,
                                onChange: function( content ) {
                                    var newObject = Object.assign({}, testimonial, {
                                        content: content,
                                    });
                                    props.setAttributes({
                                        testimonials: [].concat( _toConsumableArray( testimonials.filter( function(item) {
                                            return item.index != testimonial.index;
                                        } ) ), [newObject] )
                                    });
                                },
                                style: { color: props.attributes.quoteColor }
                            } )
                        )
                    )
                );
            } );

            return [
                el( InspectorControl, { key: 'inspector' },
                    el(
                        wp.components.PanelBody, {
                            title: wp.i18n.__( 'Content Settings' ),
                            className: 'block-contact-form',
                            initialOpen: true,
                        }
                    ),
                    el(
                        PanelColorSetting, {
                            title: wp.i18n.__( 'Color Setting' ),
                            className: 'block-color-settings',
                            initialOpen: false,
                            colorSettings: [ {
                                value: props.attributes.testimonialBg,
                                onChange: function( value ) {
                                    props.setAttributes( { testimonialBg: value } );
                                },
                                label: wp.i18n.__( 'Testimonial Background Color' ),
                            },
                            {
                                value: props.attributes.authorColor,
                                onChange: function( value ) {
                                    props.setAttributes( { authorColor: value } );
                                },
                                label: wp.i18n.__( 'Author Name Color' ),
                            },
                            {
                                value: props.attributes.quoteColor,
                                onChange: function( value ) {
                                    props.setAttributes( { quoteColor: value } );
                                },
                                label: wp.i18n.__( 'Quote Color' ),
                            }]
                        }
                    )
                ),
                el( 'div', { className: props.className },
                    testimonialList,
                    el( 'button', {
                        className: 'add-more-testimonial',
                        onClick: function( content ) {
                            return props.setAttributes({ 
                                testimonials: [].concat( _toConsumableArray( props.attributes.testimonials ), [{
                                    index: props.attributes.testimonials.length,
                                    content: '',
                                    author: '',
                                    link: ''
                                }] )
                            });
                        }
                    }, '+' )
                )
            ];
        },
        save: function( props ) {
            var _props$attributes = props.attributes,
                id = _props$attributes.id,
                testimonials = _props$attributes.testimonials;
 
            return(
                el( 'div', { className: props.className  }, 
                    el( 'div', { className: 'row justify-content-md-center' },
                        el( 'div', { className: 'col-md-10' },
                            el( 'div', { 
                                className: 'testimonial-carousel owl-carousel',
                                'data-owl-items': '1',
                                'data-owl-dots': '1',
                                'data-owl-margin': '30',
                                'data-animate': 'hg-fadeInUp',
                            }, testimonials.map(function(testimonial) {
                                return el( 'div', { className: 'item', key: testimonial.index },
                                    el( 'div', { className: 'client-testimonial' },
                                        el( 'span', { className: 'testimonial-index', style: { display: 'none' } }, testimonial.index ),
                                        el( 'div', { className: 'client-thumb' },
                                            el( 'img', {
                                                src: testimonial.image,
                                                alt: testimonial.author
                                            } )
                                        ),
                                        el( 'div', { className: 'testimonial-details', style: { backgroundColor: props.attributes.testimonialBg } },
                                            el( 'div', { className: 'client-area' },
                                                el( 'div', { className: 'client-detail' },
                                                    el( 'h4', { className: 'client-name', style: { color: props.attributes.authorColor } }, testimonial.author )
                                                )
                                            ),
                                            el( 'div', { className: 'details' },
                                                el( 'p', { className: 'testimonial-text', style: { color: props.attributes.quoteColor } }, testimonial.content )
                                            )
                                        )
                                    )
                                )
                            } ) )
                        )
                    )
                )
            );
        }
    });
})(
    window.wp.blocks,
    window.wp.element
);

/* ---------------------------------------------
 Contact Info Items
--------------------------------------------- */
( function( blocks, element, editor, components ) {
    // Necessary Module
    var el = element.createElement;
    var source = blocks.source;
    var RichText = wp.editor.RichText;
    var BlockControl = wp.editor.BlockControls;
    var InspectorControl = wp.editor.InspectorControls;
    var TextControls = wp.components.TextControl;
    var ColorPalettes = wp.editor.ColorPalette;
    var PanelColorSetting = wp.editor.PanelColorSettings;

    // Block Register
    blocks.registerBlockType( 'intrinsic-core/contact-info', {
        title: wp.i18n.__('Contact Info'),
        description: wp.i18n.__('Add a contact info.'),
        icon: 'phone',
        category: 'intrinsic-blocks',
        attributes: {
            iconCode: {
                type: 'string',
                default: 'fas fa-envelope'
            },      
            infoTitle: {
                type: 'array',
                source: 'children',
                selector: '.info-title',
            },         
            infoDetails: {
                type: 'array',
                source: 'children',
                selector: '.info-detail',
            },             
            iconBg: {
                type: 'string',
                default: '#e51681',
            },    
            infoTitleColor: {
                type: 'string',
                default: '#ffffff',
            },   
            infodetailColor: {
                type: 'string',
                default: '#dddddd',
            }
        },
        edit: function( props ) {
            return [
                el( InspectorControl, { key: 'inspector' },
                    el(
                        wp.components.PanelBody, {
                            title: wp.i18n.__( 'Content Settings' ),
                            className: 'block-headings-icons',
                            initialOpen: true,
                        },
                        el( TextControls, {
                            label: wp.i18n.__( 'Icon Code' ),
                            value: props.attributes.iconCode,
                            onChange: function( value ) {
                                props.setAttributes({ iconCode: value });
                            }
                        } )
                    ),
                    el(
                        PanelColorSetting, {
                            title: wp.i18n.__( 'Color Setting' ),
                            className: 'block-color-settings',
                            initialOpen: false,
                            colorSettings: [{
                                value: props.attributes.iconBg,
                                onChange: function( value ) {
                                    props.setAttributes( { iconBg: value } );
                                },
                                label: wp.i18n.__( 'Icon Background Color' ),
                            }, 
                            {
                                value: props.attributes.infoTitleColor,
                                onChange: function( value ) {
                                    props.setAttributes( { infoTitleColor: value } );
                                },
                                label: wp.i18n.__( 'Title Color' ),
                            },
                            {
                                value: props.attributes.infodetailColor,
                                onChange: function( value ) {
                                    props.setAttributes( { infodetailColor: value } );
                                },
                                label: wp.i18n.__( 'Description Color' ),
                            }]
                        }
                    )
                ),
                el( 'div', { className: props.className },
                    el( 'div', { className: 'contact-item' },
                        el( 'div', { className: 'icon' },
                            el( 'i', { className: props.attributes.iconCode }, props.attributes.iconCode )
                        ),
                        el( 'div', { className: 'details' }, 
                            el( RichText, {
                                tagName: 'h3',
                                className: 'info-title',
                                placeholder: wp.i18n.__( 'Add Title... ' ),
                                value: props.attributes.infoTitle,
                                onChange: function( value ) {
                                    props.setAttributes({ infoTitle: value });
                                }
                            } ),
                            el( RichText, {
                                tagName: 'p',
                                className: 'info-detail',
                                placeholder: wp.i18n.__( 'Add Details... ' ),
                                value: props.attributes.infoDetails,
                                onChange: function( value ) {
                                    props.setAttributes({ infoDetails: value });
                                }
                            } )
                        )
                    )
                )
            ];
        },
        save: function( props ) {
            return(
                el( 'div', { className: props.className },
                    el( 'div', { className: 'contact-item' },
                        el( 'div', { className: 'icon' },
                            el( 'i', { 
                                className: props.attributes.iconCode,
                                style: { backgroundColor: props.attributes.iconBg }
                            } )
                        ),
                        el( 'div', { className: 'details' },
                            el( RichText.Content, {
                                tagName: 'h3',
                                className: 'info-title',
                                value: props.attributes.infoTitle,
                                style: { color: props.attributes.infoTitleColor }
                            } ),
                            el( RichText.Content, {
                                tagName: 'p',
                                className: 'info-detail',
                                value: props.attributes.infoDetails,
                                style: { color: props.attributes.infodetailColor }
                            } )
                        ) 
                    )
                )
            );
        }
    });

})(
    window.wp.blocks,
    window.wp.element
);

/* ---------------------------------------------
 Section Container
--------------------------------------------- */
( function( blocks, element, editor, components ) {
    // Necessary Module
    var el = element.createElement;
    var source = blocks.source;
    var RichText = wp.editor.RichText;
    var BlockControl = wp.editor.BlockControls;
    var InspectorControl = wp.editor.InspectorControls;
    var TextControls = wp.components.TextControl;
    var ColorPalettes = wp.editor.ColorPalette;
    var PanelColorSetting = wp.editor.PanelColorSettings;
    var RangeControls = wp.components.RangeControl;
    var ResponsiveWrapper = wp.components.ResponsiveWrapper;
    var BlockAlignmentToolbar = wp.editor.BlockAlignmentToolbar;
    var MediaUploads = wp.editor.MediaUpload;
    var ToggleControl = wp.components.ToggleControl;
    var SelectControl = wp.components.SelectControl;
    var InnerBlocks = wp.editor.InnerBlocks;
    var validAlignments = [ 'center', 'wide', 'full' ];

    // Block Register
    blocks.registerBlockType( 'intrinsic-core/section-container', {
        title: wp.i18n.__('Container'),
        description: wp.i18n.__('Add a container block to wrap several blocks in a parent container.'),
        icon: 'welcome-add-page',
        category: 'intrinsic-blocks',
        getEditWrapperProps( attributes ) {
            var align = attributes.containerWidth;
            if ( -1 !== validAlignments.indexOf( align ) ) {
                return { 'data-align': align };
            }
        },
        attributes: {
            containerID: {
                type: 'string',
            },        
            containerPaddingTop: {
                type: 'number',
                default: 0,
            },
            containerPaddingRight: {
                type: 'number',
                default: 0,
            },
            containerPaddingBottom: {
                type: 'number',
                default: 0,
            },
            containerPaddingLeft: {
                type: 'number',
                default: 0,
            },
            containerMarginTop: {
                type: 'number',
                default: 0,
            },
            containerMarginBottom: {
                type: 'number',
                default: 0,
            },
            containerWidth: {
                type: 'string',
                default: 'center',
            },
            containerMaxWidth: {
                type: 'number',
                default: 1140,
            },            
            containerBackgroundColor: {
                type: 'string',
                default: '#ffffff',
            },
            containerImgURL: {
                type: 'string',
                selector: '.hg-background-image',
            },
            containerImgID: {
                type: 'number',
            },
            containerImgAlt: {
                type: 'string',
                source: 'attribute',
                attribute: 'alt',
                selector: 'img',
            },
            enableParallax: {
                type: 'boolean',
                default: false
            },
            parallaxSpeed: {
                type: 'number',
                default: 3,
            },
            containerDimRatio: {
                type: 'number',
                default: 1,
            },
            bgSize: {
                type: 'string',
                default: 'inherit',
            },
            bgPos: {
                type: 'string',
                default: 'inherit',
            },
            bgRepeat: {
                type: 'string',
                default: 'normal',
            },
            bgAttachements: {
                type: 'string',
                default: 'inherit',
            },
            bgColor: {
                type: 'string',
                default: '#ffffff',
            },
            bgTextColor: {
                type: 'string',
                default: '#3c3c3c',
            },
            overlayBg: {
                type: 'string',
                default: '#ffffff',
            },
        },
        edit: function( props ) {

            var onSelectImage = function( img ) {
                return props.setAttributes( {
                    containerImgID: img.id,
                    containerImgURL: img.url,
                    containerImgAlt: img.alt,
                } );
            };

            var onRemoveImage = function() {
                return props.setAttributes( {
                    containerImgID: null,
                    containerImgURL: null,
                    containerImgAlt: null,
                } );
            };

            return [
                el( InspectorControl, { key: 'inspector' },
                    el(
                        wp.components.PanelBody, {
                            title: wp.i18n.__( 'Spacing Settings' ),
                            className: 'block-headings-icons',
                            initialOpen: true,
                        },
                        el( RangeControls, {
                            label: wp.i18n.__( 'Padding Top (%)' ),
                            value: props.attributes.containerPaddingTop,
                            onChange: function( value ) {
                                props.setAttributes({ containerPaddingTop: value });
                            },
                            min: 0,
                            max: 500,
                            step: 1,
                        } ),
                        el( RangeControls, {
                            label: wp.i18n.__( 'Padding Bottom (%)' ),
                            value: props.attributes.containerPaddingBottom,
                            onChange: function( value ) {
                                props.setAttributes({ containerPaddingBottom: value });
                            },
                            min: 0,
                            max: 500,
                            step: 1,
                        } ),
                        el( RangeControls, {
                            label: wp.i18n.__( 'Padding Left (%)' ),
                            value: props.attributes.containerPaddingLeft,
                            onChange: function( value ) {
                                props.setAttributes({ containerPaddingLeft: value });
                            },
                            min: 0,
                            max: 500,
                            step: 1,
                        } ),
                        el( RangeControls, {
                            label: wp.i18n.__( 'Padding Right (%)' ),
                            value: props.attributes.containerPaddingRight,
                            onChange: function( value ) {
                                props.setAttributes({ containerPaddingRight: value });
                            },
                            min: 0,
                            max: 500,
                            step: 1,
                        } ),
                        el( RangeControls, {
                            label: wp.i18n.__( 'Margin Top (%)' ),
                            value: props.attributes.containerMarginTop,
                            onChange: function( value ) {
                                props.setAttributes({ containerMarginTop: value });
                            },
                            min: 0,
                            max: 500,
                            step: 1,
                        } ),
                        el( RangeControls, {
                            label: wp.i18n.__( 'Margin Bottom (%)' ),
                            value: props.attributes.containerMarginBottom,
                            onChange: function( value ) {
                                props.setAttributes({ containerMarginBottom: value });
                            },
                            min: 0,
                            max: 500,
                            step: 1,
                        } ),
                        el( RangeControls, {
                            label: wp.i18n.__( 'Inside Container Max Width (px)' ),
                            value: props.attributes.containerMaxWidth,
                            onChange: function( value ) {
                                props.setAttributes({ containerMaxWidth: value });
                            },
                            min: 500,
                            max: 2400,
                            step: 1,
                        } )
                    ),
                    el(
                        wp.components.PanelBody, {
                            title: wp.i18n.__( 'Element ID' ),
                            className: 'block-headings-icons',
                            initialOpen: true,
                        },
                        el( TextControls, {
                            label: wp.i18n.__( 'Container ID' ),
                            value: props.attributes.containerID,
                            onChange: function( value ) {
                                props.setAttributes({ containerID: value });
                            }
                        } )
                    ),
                    el(
                        wp.components.PanelBody, {
                            title: wp.i18n.__( 'Background Options' ),
                            className: 'block-background-options',
                            initialOpen: true,
                        },
                        el( MediaUploads, {
                            onSelect: onSelectImage,
                            type: 'image',
                            value: props.attributes.containerImgID,
                            render: function( obj ) {
                                return [
                                    el( wp.components.Button, {
                                        className: props.attributes.containerImgID ? 'image-button' : 'editor-post-featured-image__toggle',
                                        modalClass: 'editor-post-featured-image__media-modal',
                                        onClick: obj.open
                                    }, !props.attributes.containerImgID ? el( 'span', { className: 'no-image' }, wp.i18n.__('Select Background Image') ) : el( 'img', { src: props.attributes.containerImgURL } ),
                                    ),
                                    props.attributes.containerImgID && el( wp.components.Button, {
                                        className: 'is-link is-destructive',
                                        onClick: onRemoveImage
                                    }, wp.i18n.__('Remove Image') )
                                ];
                            }
                        }),
                        props.attributes.containerImgURL && el( RangeControls, {
                            label: wp.i18n.__( 'Image Opacity' ),
                            value: props.attributes.containerDimRatio,
                            onChange: function( value ) {
                                props.setAttributes({ containerDimRatio: value });
                            },
                            min: 0,
                            max: 1,
                            step: 0.1,
                        } ),
                        props.attributes.containerImgURL && el( SelectControl, {
                            label: wp.i18n.__( 'Background Size' ),
                            value: props.attributes.bgSize,
                            options: [
                                { value: 'auto', label: wp.i18n.__( 'Auto' ) },
                                { value: 'contain', label: wp.i18n.__( 'Contain' ) },
                                { value: 'cover', label: wp.i18n.__( 'Cover' ) },
                                { value: 'inherit', label: wp.i18n.__( 'Inherit' ) },
                            ],
                            onChange: function( value ) {
                                props.setAttributes({ bgSize: value });
                            }
                        } ),
                        props.attributes.containerImgURL && el( SelectControl, {
                            label: wp.i18n.__( 'Background Position' ),
                            value: props.attributes.bgPos,
                            options: [
                                { value: 'center', label: wp.i18n.__( 'Center' ) },
                                { value: 'top', label: wp.i18n.__( 'Top' ) },
                                { value: 'bottom', label: wp.i18n.__( 'Bottom' ) },
                                { value: 'inherit', label: wp.i18n.__( 'Inherit' ) },
                            ],
                            onChange: function( value ) {
                                props.setAttributes({ bgPos: value });
                            }
                        } ),
                        props.attributes.containerImgURL && el( SelectControl, {
                            label: wp.i18n.__( 'Background Repeat' ),
                            value: props.attributes.bgRepeat,
                            options: [
                                { value: 'repeat', label: wp.i18n.__( 'Repeat' ) },
                                { value: 'no-repeat', label: wp.i18n.__( 'No Repeat' ) },
                                { value: 'inherit', label: wp.i18n.__( 'Inherit' ) },
                            ],
                            onChange: function( value ) {
                                props.setAttributes({ bgRepeat: value });
                            }
                        } ),
                        props.attributes.containerImgURL && el( ToggleControl, {
                            label: wp.i18n.__( 'Enable/Disable Parallax' ),
                            description:  wp.i18n.__( 'Enable/Disable Parallax Background' ),
                            checked: props.attributes.enableParallax,
                            onChange: function( value ) {
                                props.setAttributes( { enableParallax: !props.attributes.enableParallax } );
                            },
                        } ),
                        props.attributes.containerImgURL && el( RangeControls, {
                            label: wp.i18n.__( 'Parallax Speed' ),
                            value: props.attributes.parallaxSpeed,
                            onChange: function( value ) {
                                props.setAttributes({ parallaxSpeed: value });
                            },
                            min: 0,
                            max: 10,
                            step: 1,
                        } )
                    ),
                    el(
                        PanelColorSetting, {
                            title: wp.i18n.__( 'Color Setting' ),
                            className: 'block-color-settings',
                            initialOpen: false,
                            colorSettings: [
                            {
                                value: props.attributes.bgTextColor,
                                onChange: function( value ) {
                                    props.setAttributes( { bgTextColor: value } );
                                },
                                label: wp.i18n.__( 'Text Color' ),
                            },
                            {
                                value: props.attributes.overlayBg,
                                onChange: function( value ) {
                                    props.setAttributes( { overlayBg: value } );
                                },
                                label: wp.i18n.__( 'Background Color' ),
                            }]
                        }
                    )
                ),
                el(
                    BlockControl, { key: 'controls' },
                    el( BlockAlignmentToolbar, {
                        value: props.attributes.containerWidth,
                        onChange: function( value ) {
                            props.setAttributes({ containerWidth: value });
                        },
                        controls: [ 'center', 'wide', 'full' ]
                    })
                ),
                el( 'div', { className: props.className + ' align'+ props.attributes.containerWidth },
                    el( 'section', { 
                        className: 'intrinsic-sections',
                        id: props.attributes.containerID,
                        style: { 
                            color: props.attributes.bgTextColor,
                            paddingTop: props.attributes.containerPaddingTop + '%',
                            paddingBottom: props.attributes.containerPaddingBottom + '%',
                            paddingLeft: props.attributes.containerPaddingLeft + '%',
                            paddingRight: props.attributes.containerPaddingRight + '%',
                            marginTop: props.attributes.containerMarginTop+'%',
                            marginBottom: props.attributes.containerMarginBottom+'%',
                        }
                    }, el( 'div', { className: 'container', style: { maxWidth: props.attributes.containerMaxWidth } },
                            el( InnerBlocks )
                        ),
                        props.attributes.enableParallax && el( 'div', { 
                            className: 'hg-background hg-overlay',
                            'data-bg-parallax': 'scroll',
                            'data-bg-parallax-speed': props.attributes.parallaxSpeed,
                            style: { backgroundColor: props.attributes.overlayBg }
                        }, el( 'div', {
                            className: 'hg-background-image hg-parallax-element',
                            style: { backgroundImage: 'url('+ props.attributes.containerImgURL +')', opacity: props.attributes.containerDimRatio, backgroundSize: props.attributes.bgSize, backgroundPosition: props.attributes.bgPos, backgroundRepeat: props.attributes.bgRepeat  }
                        } ) ),
                        ! props.attributes.enableParallax && el( 'div', { 
                            className: 'hg-background hg-overlay',
                            style: { backgroundColor: props.attributes.overlayBg }
                        }, el( 'div', {
                            className: 'hg-background-image',
                            style: { backgroundImage: 'url('+ props.attributes.containerImgURL +')', opacity: props.attributes.containerDimRatio, backgroundSize: props.attributes.bgSize, backgroundPosition: props.attributes.bgPos, backgroundRepeat: props.attributes.bgRepeat  }
                        } ) )
                    )
                )
            ];
        },
        save: function( props ) {
            return(
                el( 'div', { className: props.className + ' align'+ props.attributes.containerWidth }, el( 'section', { 
                        className: 'intrinsic-sections',
                        id: props.attributes.containerID,
                        style: { 
                            color: props.attributes.bgTextColor,
                            paddingTop: props.attributes.containerPaddingTop + '%',
                            paddingBottom: props.attributes.containerPaddingBottom + '%',
                            paddingLeft: props.attributes.containerPaddingLeft + '%',
                            paddingRight: props.attributes.containerPaddingRight + '%',
                            marginTop: props.attributes.containerMarginTop+'%',
                            marginBottom: props.attributes.containerMarginBottom+'%',
                        }
                    }, el('div', { className: 'container', style: { maxWidth: props.attributes.containerMaxWidth } },
                            el( InnerBlocks.Content )
                        ),
                        props.attributes.enableParallax && el( 'div', { 
                            className: 'hg-background hg-overlay',
                            'data-bg-parallax': 'scroll',
                            'data-bg-parallax-speed': props.attributes.parallaxSpeed,
                            style: { backgroundColor: props.attributes.overlayBg }
                        }, el( 'div', {
                            className: 'hg-background-image hg-parallax-element',
                            style: { backgroundImage: 'url('+ props.attributes.containerImgURL +')', opacity: props.attributes.containerDimRatio, backgroundSize: props.attributes.bgSize, backgroundPosition: props.attributes.bgPos, backgroundRepeat: props.attributes.bgRepeat  }
                        } ) ),
                        ! props.attributes.enableParallax && el( 'div', { 
                            className: 'hg-background hg-overlay',
                            style: { backgroundColor: props.attributes.overlayBg }
                        }, el( 'div', {
                            className: 'hg-background-image',
                            style: { backgroundImage: 'url('+ props.attributes.containerImgURL +')', opacity: props.attributes.containerDimRatio, backgroundSize: props.attributes.bgSize, backgroundPosition: props.attributes.bgPos, backgroundRepeat: props.attributes.bgRepeat  }
                        } ) )
                    )
      
                )
            );
        }
    });

})(
    window.wp.blocks,
    window.wp.element
);