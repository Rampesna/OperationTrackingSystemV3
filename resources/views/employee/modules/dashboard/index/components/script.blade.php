<script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/fullcalendar/locales-all-min.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/qrcode/creator.js') }}"></script>
<script src="{{ asset('assets/ejDiagram/ej.web.all.min.js') }}"></script>
<script>

    var constraints = ej.datavisualization.Diagram.NodeConstraints.Default | ej.datavisualization.Diagram.NodeConstraints.AspectRatio;
    var palettes = [
        {
            name: "Şekiller",
            expanded: true,
            items: [
                //add the flow shapes to the symbol palette
                {
                    name: "Terminator",
                    width: 40,
                    height: 20,
                    offsetX: 20,
                    offsetY: 20,
                    type: "flow",
                    shape: ej.datavisualization.Diagram.FlowShapes.Terminator,
                    ports: [
                        {name: "Terminator" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0.5, y: 0}},
                        {name: "Terminator" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0, y: 0.5}},
                        {name: "Terminator" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0.5, y: 1}},
                        {name: "Terminator" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 1, y: 0.5}}
                    ]
                },
                {
                    name: "process",
                    width: 40,
                    height: 20,
                    offsetX: 20,
                    offsetY: 20,
                    type: "flow",
                    shape: ej.datavisualization.Diagram.FlowShapes.Process,
                    ports: [{
                        name: "process" + ej.datavisualization.Diagram.Util.randomId(),
                        constraints: ej.datavisualization.Diagram.PortConstraints.Connect | ej.datavisualization.Diagram.PortConstraints.ConnectOnDrag,
                        offset: {x: 0, y: 0.5}
                    }, {
                        name: "process" + ej.datavisualization.Diagram.Util.randomId(),
                        offset: {x: 0, y: 0.3},
                        constraints: ej.datavisualization.Diagram.PortConstraints.Connect | ej.datavisualization.Diagram.PortConstraints.ConnectOnDrag,
                    }, {
                        name: "Rectangle" + ej.datavisualization.Diagram.Util.randomId(),
                        offset: {x: 0, y: 0.7},
                        constraints: ej.datavisualization.Diagram.PortConstraints.Connect | ej.datavisualization.Diagram.PortConstraints.ConnectOnDrag,
                    },
                        {
                            name: "process" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {y: 0, x: 0.5},
                            constraints: ej.datavisualization.Diagram.PortConstraints.Connect | ej.datavisualization.Diagram.PortConstraints.ConnectOnDrag,
                        }, {
                            name: "process" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {y: 0, x: 0.3},
                            constraints: ej.datavisualization.Diagram.PortConstraints.Connect | ej.datavisualization.Diagram.PortConstraints.ConnectOnDrag,
                        }, {
                            name: "Rectangle" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {y: 0, x: 0.7},
                            constraints: ej.datavisualization.Diagram.PortConstraints.Connect | ej.datavisualization.Diagram.PortConstraints.ConnectOnDrag,
                        },
                        {
                            name: "process" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 1, y: 0.5}
                        }, {
                            name: "process" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 1, y: 0.3}
                        }, {name: "Rectangle" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 1, y: 0.7}},
                        {
                            name: "process" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {y: 1, x: 0.5}
                        }, {
                            name: "process" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {y: 1, x: 0.3}
                        }, {name: "Rectangle" + ej.datavisualization.Diagram.Util.randomId(), offset: {y: 1, x: 0.7}}]
                },
                {
                    name: "Decision",
                    width: 40,
                    height: 35,
                    offsetX: 20,
                    offsetY: 20,
                    type: "flow",
                    shape: ej.datavisualization.Diagram.FlowShapes.Decision,
                    ports: [{name: "Decision" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0, y: 0.5}},
                        {name: "Decision" + ej.datavisualization.Diagram.Util.randomId(), offset: {y: 0, x: 0.5}},
                        {name: "Decision" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 1, y: 0.5}},
                        {name: "Decision" + ej.datavisualization.Diagram.Util.randomId(), offset: {y: 1, x: 0.5}}]
                },
                {
                    name: "Sort",
                    width: 40,
                    height: 40,
                    offsetX: 20,
                    offsetY: 20,
                    type: "flow",
                    shape: ej.datavisualization.Diagram.FlowShapes.Sort,
                    ports: [
                        {name: "Sort" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0.5, y: 0}},
                        {name: "Sort" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 1, y: 0.5}},
                        {name: "Sort" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0.5, y: 1}},
                        {name: "Sort" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0, y: 0.5}},
                    ]
                },
                {
                    name: "Document",
                    width: 40,
                    height: 30,
                    offsetX: 20,
                    offsetY: 15,
                    type: "flow",
                    shape: ej.datavisualization.Diagram.FlowShapes.Document,
                    ports: [{name: "Document" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0, y: 0}},
                        {name: "Document" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0.5, y: 0}},
                        {name: "Document" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 1, y: 0}},
                        {name: "Document" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 1, y: 0.5}},
                        {name: "Document" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 1, y: 1}},
                        {name: "Document" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0.5, y: 1}},
                        {name: "Document" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0, y: 1}},
                        {name: "Document" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0, y: 0.5}}]
                },
                {
                    name: "MultiDocument",
                    width: 40,
                    height: 30,
                    offsetX: 20,
                    offsetY: 15,
                    type: "flow",
                    shape: ej.datavisualization.Diagram.FlowShapes.MultiDocument,
                    ports: [
                        {name: "MultiDocument" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0, y: 0.5}},
                        {name: "MultiDocument" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0, y: 0}},
                        {name: "MultiDocument" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0.5, y: 0}},
                        {name: "MultiDocument" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 1, y: 0}},
                        {name: "MultiDocument" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 1, y: 0.5}},
                        {name: "MultiDocument" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 1, y: 1}},
                        {name: "MultiDocument" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0.5, y: 1}},
                        {name: "MultiDocument" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0, y: 1}}]
                },
                {
                    name: "DirectData",
                    width: 40,
                    height: 30,
                    offsetX: 20,
                    offsetY: 15,
                    type: "flow",
                    shape: ej.datavisualization.Diagram.FlowShapes.DirectData,
                    ports: [
                        {name: "DirectData" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0.1, y: 0}},
                        {name: "DirectData" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0.5, y: 0}},
                        {name: "DirectData" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0.9, y: 0}},
                        {name: "DirectData" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0.9, y: 1}},
                        {name: "DirectData" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0.5, y: 1}},
                        {name: "DirectData" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0.1, y: 1}},
                        {name: "DirectData" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0, y: 0.5}},
                        {name: "DirectData" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 1, y: 0.5}},
                    ]
                },
                {
                    name: "SequentialData",
                    width: 40,
                    height: 40,
                    offsetX: 20,
                    offsetY: 20,
                    type: "flow",
                    shape: ej.datavisualization.Diagram.FlowShapes.SequentialData,
                    ports: [
                        {name: "SequentialData" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0.5, y: 0}},
                        {name: "SequentialData" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 1, y: 0.5}},
                        {name: "SequentialData" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0.5, y: 1}},
                        {name: "SequentialData" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0, y: 0.5}},
                        {
                            name: "SequentialData" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 0.152, y: 0.15}
                        },
                        {
                            name: "SequentialData" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 0.815, y: 0.15}
                        },
                        {
                            name: "SequentialData" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 0.815, y: 0.85}
                        },
                        {
                            name: "SequentialData" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 0.152, y: 0.85}
                        },
                        {name: "SequentialData" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 1, y: 1}},
                    ]
                },
                {
                    name: "PaperTap",
                    width: 40,
                    height: 30,
                    offsetX: 20,
                    offsetY: 15,
                    type: "flow",
                    shape: ej.datavisualization.Diagram.FlowShapes.PaperTap,
                    ports: [
                        {name: "PaperTap" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0, y: 0.5}},
                        {name: "PaperTap" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0.5, y: 0.1}},
                        {name: "PaperTap" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 1, y: 0.1}},
                        {name: "PaperTap" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 1, y: 0.5}},
                        {name: "PaperTap" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 1, y: 0.9}},
                        {name: "PaperTap" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0.5, y: 0.9}},
                        {name: "PaperTap" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0, y: 0.9}},
                        {name: "PaperTap" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0, y: 0.1}},
                    ]
                },

                {
                    name: "Collate",
                    width: 40,
                    height: 40,
                    offsetX: 20,
                    offsetY: 20,
                    type: "flow",
                    shape: ej.datavisualization.Diagram.FlowShapes.Collate,
                    ports: [
                        {name: "Collate" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0, y: 0}},
                        {name: "Collate" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0.5, y: 0}},
                        {name: "Collate" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 1, y: 0}},
                        {name: "Collate" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 1, y: 1}},
                        {name: "Collate" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0.5, y: 1}},
                        {name: "Collate" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0, y: 1}}]
                },
                {
                    name: "Summing_Junction",
                    width: 40,
                    height: 40,
                    offsetX: 20,
                    offsetY: 20,
                    type: "flow",
                    shape: ej.datavisualization.Diagram.FlowShapes.SummingJunction,
                    constraints: constraints,
                    ports: [
                        {
                            name: "Summing_Junction" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 0.5, y: 0}
                        },
                        {
                            name: "Summing_Junction" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 1, y: 0.5}
                        },
                        {
                            name: "Summing_Junction" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 0.5, y: 1}
                        },
                        {
                            name: "Summing_Junction" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 0, y: 0.5}
                        },
                        {
                            name: "Summing_Junction" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 0.152, y: 0.15}
                        },
                        {
                            name: "Summing_Junction" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 0.852, y: 0.15}
                        },
                        {
                            name: "Summing_Junction" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 0.852, y: 0.85}
                        },
                        {
                            name: "Summing_Junction" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 0.152, y: 0.85}
                        }

                    ]
                },
                {
                    name: "Or",
                    width: 40,
                    height: 40,
                    offsetX: 20,
                    offsetY: 20,
                    type: "flow",
                    shape: ej.datavisualization.Diagram.FlowShapes.Or,
                    ports: [
                        {name: "Or" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0.5, y: 0}},
                        {name: "Or" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 1, y: 0.5}},
                        {name: "Or" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0.5, y: 1}},
                        {name: "Or" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0, y: 0.5}},
                        {name: "Or" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0.152, y: 0.15}},
                        {name: "Or" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0.852, y: 0.15}},
                        {name: "Or" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0.852, y: 0.85}},
                        {name: "Or" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0.152, y: 0.85}}
                    ]
                },
                {
                    name: "InternalStorage",
                    width: 40,
                    height: 40,
                    offsetX: 40,
                    offsetY: 15,
                    type: "flow",
                    shape: ej.datavisualization.Diagram.FlowShapes.InternalStorage,
                    ports: [
                        {name: "InternalStorage" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0, y: 0}},
                        {
                            name: "InternalStorage" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 0.5, y: 0}
                        },
                        {name: "InternalStorage" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 1, y: 0}},
                        {
                            name: "InternalStorage" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 1, y: 0.5}
                        },
                        {name: "InternalStorage" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 1, y: 1}},
                        {
                            name: "InternalStorage" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 0.5, y: 1}
                        },
                        {name: "InternalStorage" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0, y: 1}},
                        {
                            name: "InternalStorage" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 0, y: 0.5}
                        },
                    ]
                },
                {
                    name: "PredefinedProcess",
                    width: 40,
                    height: 30,
                    offsetX: 20,
                    offsetY: 15,
                    type: "flow",
                    shape: ej.datavisualization.Diagram.FlowShapes.PreDefinedProcess,
                    ports: [
                        {
                            name: "PredefinedProcess" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 0, y: 0}
                        },
                        {
                            name: "PredefinedProcess" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 0.5, y: 0}
                        },
                        {
                            name: "PredefinedProcess" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 1, y: 0}
                        },
                        {
                            name: "PredefinedProcess" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 1, y: 0.5}
                        },
                        {
                            name: "PredefinedProcess" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 1, y: 1}
                        },
                        {
                            name: "PredefinedProcess" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 0.5, y: 1}
                        },
                        {
                            name: "PredefinedProcess" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 0, y: 1}
                        },
                        {
                            name: "PredefinedProcess" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 0, y: 0.5}
                        }
                    ]
                },
                {
                    name: "Extract",
                    width: 40,
                    height: 40,
                    offsetX: 20,
                    offsetY: 20,
                    type: "flow",
                    shape: ej.datavisualization.Diagram.FlowShapes.Extract,
                    ports: [
                        {name: "Extract" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0.5, y: 0}},
                        {name: "Extract" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 1, y: 1}},
                        {name: "Extract" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0.5, y: 1}},
                        {name: "Extract" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0, y: 1}}
                    ]
                },
                {
                    name: "Merge",
                    width: 40,
                    height: 40,
                    offsetX: 20,
                    offsetY: 20,
                    type: "flow",
                    shape: ej.datavisualization.Diagram.FlowShapes.Merge,
                    ports: [
                        {name: "Merge" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0, y: 0}},
                        {name: "Merge" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0.5, y: 1}},
                        {name: "Merge" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0.5, y: 0}},
                        {name: "Merge" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 1, y: 0}}
                    ]
                },
                {
                    name: "Off_Page_Reference",
                    width: 40,
                    height: 40,
                    offsetX: 20,
                    offsetY: 20,
                    type: "flow",
                    shape: ej.datavisualization.Diagram.FlowShapes.OffPageReference,
                    ports: [
                        {
                            name: "Off_Page_Reference" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 0, y: 0}
                        },
                        {
                            name: "Off_Page_Reference" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 0.5, y: 1}
                        },
                        {
                            name: "Off_Page_Reference" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 0, y: 0.5}
                        },
                        {
                            name: "Off_Page_Reference" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 0.5, y: 0}
                        },
                        {
                            name: "Off_Page_Reference" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 1, y: 0}
                        },
                        {
                            name: "Off_Page_Reference" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 1, y: 0.5}
                        }
                    ]
                },
                {
                    name: "Sequential_Access_Storage",
                    width: 40,
                    height: 40,
                    offsetX: 20,
                    offsetY: 20,
                    type: "flow",
                    shape: ej.datavisualization.Diagram.FlowShapes.SequentialAccessStorage,
                    ports: [
                        {
                            name: "Sequential_Access_Storage" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 0.45, y: 0}
                        },
                        {
                            name: "Sequential_Access_Storage" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 1, y: 1}
                        },
                        {
                            name: "Sequential_Access_Storage" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 0, y: 0.5}
                        },
                        {
                            name: "Sequential_Access_Storage" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 1, y: 0.5}
                        },
                        {
                            name: "Sequential_Access_Storage" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 0.45, y: 1}
                        }
                    ]
                },
                {
                    name: "ManualOperation",
                    width: 40,
                    height: 40,
                    offsetX: 20,
                    offsetY: 20,
                    type: "flow",
                    shape: ej.datavisualization.Diagram.FlowShapes.ManualOperation,
                    ports: [
                        {
                            name: "ManualOperation" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 0.5, y: 0}
                        },
                        {
                            name: "ManualOperation" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 0, y: 0.5}
                        },
                        {
                            name: "ManualOperation" + ej.datavisualization.Diagram.Util.randomId(),
                            offset: {x: 1, y: 0.5}
                        },
                        {name: "ManualOperation" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0.5, y: 1}}
                    ]
                },
                {
                    name: "Annotation1",
                    width: 40,
                    height: 40,
                    offsetX: 20,
                    offsetY: 20,
                    type: "flow",
                    shape: ej.datavisualization.Diagram.FlowShapes.Annotation1,
                    ports: [
                        {name: "Annotation1" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0.5, y: 0}},
                        {name: "Annotation1" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0, y: 0.5}},
                        {name: "Annotation1" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 1, y: 0.5}},
                        {name: "Annotation1" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0.5, y: 1}}
                    ]
                },
                {
                    name: "Annotation2",
                    width: 40,
                    height: 40,
                    offsetX: 20,
                    offsetY: 20,
                    type: "flow",
                    shape: ej.datavisualization.Diagram.FlowShapes.Annotation2,
                    ports: [
                        {name: "Annotation2" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0.5, y: 0}},
                        {name: "Annotation2" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0, y: 0.5}},
                        {name: "Annotation2" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 1, y: 0.5}},
                        {name: "Annotation2" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0.5, y: 1}}
                    ]
                },
                {
                    name: "Data",
                    width: 40,
                    height: 40,
                    offsetX: 20,
                    offsetY: 20,
                    type: "flow",
                    shape: ej.datavisualization.Diagram.FlowShapes.Data,
                    ports: [
                        {name: "Data" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0.5, y: 0}},
                        {name: "Data" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0, y: 0.5}},
                        {name: "Data" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 1, y: 0.5}},
                        {name: "Data" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0.5, y: 1}}
                    ]
                },
                {
                    name: "Card",
                    width: 40,
                    height: 40,
                    offsetX: 20,
                    offsetY: 20,
                    type: "flow",
                    shape: ej.datavisualization.Diagram.FlowShapes.Card,
                    ports: [
                        {name: "Card" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0.5, y: 0}},
                        {name: "Card" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0, y: 0.5}},
                        {name: "Card" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 1, y: 0.5}},
                        {name: "Card" + ej.datavisualization.Diagram.Util.randomId(), offset: {x: 0.5, y: 1}}
                    ]
                },
            ]
        },
        {
            name: " Bağlantılar",
            expanded: true,
            items: [
                //add the connectors to the symbol palette
                {
                    name: "Link1",
                    segments: [{type: "orthogonal"}],
                    sourcePoint: {x: 0, y: 0},
                    targetPoint: {x: 40, y: 40},
                    targetDecorator: {shape: "arrow", borderColor: "#A9A9A9", fillColor: "#A9A9A9"},
                    lineWidth: 2,
                    lineColor: "#A9A9A9"
                },
                {
                    name: "Link21",
                    segments: [{type: "straight"}],
                    sourcePoint: {x: 0, y: 0},
                    targetPoint: {x: 40, y: 40},
                    targetDecorator: {shape: "arrow", borderColor: "#A9A9A9", fillColor: "#A9A9A9"},
                    lineWidth: 2,
                    lineColor: "#A9A9A9"
                },
            ],
        }
    ];

    var margin = {"left": 0, "top": 0, "right": 0, "bottom": 0};
    var FlowShapes = ej.datavisualization.Diagram.FlowShapes;
    var nodes = [];

    var connectors = [];

    if (!(ej.browserInfo().name === "msie" && Number(ej.browserInfo().version) < 9)) {
        jQuery(function () {
            $("#symbolpalette").ejSymbolPalette({
                diagramId: "diagram",
                palettes: palettes,
                width: "100%",
                height: "100%",
                paletteItemWidth: 50,
                paletteItemHeight: 50,
                previewWidth: 100,
                previewHeight: 100,
                showPaletteItemText: false,
                defaultSettings: {
                    node: {
                        fillColor: "white"
                    },
                }
            });
            $("#diagram").ejDiagram({
                width: "100%",
                height: "600px",
                nodes: nodes,
                nodeCollectionChange: nodeCollectionChange,
                pageSettings: {
                    scrollLimit: "diagram"
                },
                defaultSettings: {
                    node: {
                        borderColor: "#1BA0E2", fillColor: "#1BA0E2", labels: [
                            {
                                "fontColor": "white"
                            }
                        ],
                        ports: [
                            {
                                name: "port1",
                                offset: {
                                    x: 0,
                                    y: 0.2
                                }
                            },
                            {
                                name: "port2",
                                offset: {
                                    y: 0,
                                    x: 0.2
                                }
                            },
                            {
                                name: "port3",
                                offset: {
                                    x: 1,
                                    y: 0.2
                                }
                            },
                            {
                                name: "port4",
                                offset: {
                                    y: 1,
                                    x: 0.2
                                }
                            }
                        ]
                    },
                    connector: {
                        lineColor: "#606060",
                        labels: [
                            {
                                "fillColor": "white"
                            }
                        ]
                    },
                },
                connectors: connectors,
                enableContextMenu: false
            });

        });
    } else {
        alert("Diagram will not be supported in IE Version < 9");
    }

    function nodeCollectionChange(args) {
        if (args.state === "changing" && args.elementType === "node") {
            args.element.fillColor = "#1BA0E2";
        }
    }

    function diagramFitToPage(id, preventScaling) {
        if (id && window) {
            if (ej.isMobile() && ej.isDevice()) {
                var diagram = $("#" + id).ejDiagram("instance");
                diagram.fitToPage("width", "content");
                if (!preventScaling) {
                    var viewPort = ej.datavisualization.Diagram.ScrollUtil._viewPort(diagram, true);
                    var bounds = diagram._getDigramBounds("content");
                    var scale = {x: viewPort.width / bounds.width, y: viewPort.height / bounds.height};
                    $("#" + id).ejDiagram({height: $("#" + id).height() * Math.min(scale.x, scale.y)});
                    if (window.location.hostname) {
                        var iframe = top.document.getElementById('samplefile');
                        if (iframe) iframe.style.minHeight = $("#" + id).height() + "px";
                    }
                }
            }
        }
    }
</script>

<script>

    $(document).ready(function () {
        $('#loader').hide();
    });

    var createPermitTypeId = $('#create_permit_type_id');
    var updatePermitTypeId = $('#update_permit_type_id');
    var createOvertimeTypeId = $('#create_overtime_type_id');
    var updateOvertimeTypeId = $('#update_overtime_type_id');
    var createPaymentTypeId = $('#create_payment_type_id');
    var updatePaymentTypeId = $('#update_payment_type_id');

    var CreatePermitButton = $('#CreatePermitButton');
    var UpdatePermitButton = $('#UpdatePermitButton');
    var CreateOvertimeButton = $('#CreateOvertimeButton');
    var UpdateOvertimeButton = $('#UpdateOvertimeButton');
    var CreatePaymentButton = $('#CreatePaymentButton');
    var UpdatePaymentButton = $('#UpdatePaymentButton');
    var UpdateFoodListCheckButton = $('#UpdateFoodListCheckButton');
    var CreateMarketPaymentButton = $('#CreateMarketPaymentButton');

    var EditPermitButton = $('#EditPermitButton');
    var EditOvertimeButton = $('#EditOvertimeButton');
    var EditPaymentButton = $('#EditPaymentButton');

    const element = document.getElementById("calendar");

    var todayDate = moment().startOf("day");
    var YM = todayDate.format("YYYY-MM");
    var YESTERDAY = todayDate.clone().subtract(1, "day").format("YYYY-MM-DD");
    var TODAY = todayDate.format("YYYY-MM-DD");
    var TOMORROW = todayDate.clone().add(1, "day").format("YYYY-MM-DD");

    var calendarEl = document.getElementById("calendar");
    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'tr',
        themeSystem: 'bootstrap5',
        headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
        },

        nowIndicator: true,
        now: TODAY + "T{{ date('H:i:s') }}",

        initialView: "dayGridMonth",
        initialDate: TODAY,

        editable: false,
        dayMaxEvents: true,
        navLinks: true,

        dateClick: function (info) {

        },

        eventClick: function (info) {
            var type = info.event._def.extendedProps.type;
            var id = info.event._def.extendedProps._id;

            $('.fc-popover-close').click();

            if (type === 'shift') {
                $('#loader').show();
                $.ajax({
                    type: 'get',
                    url: '{{ route('employee.api.shift.getById') }}',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': token
                    },
                    data: {
                        id: id
                    },
                    success: function (response) {
                        $('#show_shift_shift_group_name_span').html(response.response.shift_group ? response.response.shift_group.name : '--');
                        $('#show_shift_start_date_span').html(reformatDatetimeToDatetimeForHuman(response.response.start_date));
                        $('#show_shift_end_date_span').html(reformatDatetimeToDatetimeForHuman(response.response.end_date));
                        $('#ShowShiftModal').modal('show');
                        $('#loader').hide();
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error('Vardiya Detayları Alınırken Serviste Bir Sorun Oluştu!');
                        $('#loader').hide();
                    }
                });
            } else if (type === 'permit') {
                $('#loader').show();
                $.ajax({
                    type: 'get',
                    url: '{{ route('employee.api.permit.getById') }}',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': token
                    },
                    data: {
                        id: id
                    },
                    success: function (response) {
                        $('#update_permit_id').val(response.response.id);
                        updatePermitTypeId.val(response.response.type_id);
                        $('#update_permit_start_date').val(reformatDateForCalendar(response.response.start_date));
                        $('#update_permit_end_date').val(reformatDateForCalendar(response.response.end_date));
                        $('#update_permit_description').val(response.response.description);
                        $('#show_permit_type_name_span').html(response.response.type ? response.response.type.name : '--');
                        $('#show_permit_status_badge_span').html(response.response.status ? response.response.status.name : '--').removeClass().addClass(`badge badge-${response.response.status ? response.response.status.color : 'secondary'}`);
                        $('#show_permit_start_date_span').html(reformatDatetimeToDatetimeForHuman(response.response.start_date));
                        $('#show_permit_end_date_span').html(reformatDatetimeToDatetimeForHuman(response.response.end_date));
                        $('#show_permit_description_input').val(response.response.description);
                        parseInt(response.response.status_id) === 1 ? EditPermitButton.show() : EditPermitButton.hide();
                        $('#ShowPermitModal').modal('show');
                        $('#loader').hide();
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error('İzin Detayları Alınırken Serviste Bir Sorun Oluştu!');
                        $('#loader').hide();
                    }
                });
            } else if (type === 'overtime') {
                $('#loader').show();
                $.ajax({
                    type: 'get',
                    url: '{{ route('employee.api.overtime.getById') }}',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': token
                    },
                    data: {
                        id: id
                    },
                    success: function (response) {
                        $('#update_overtime_id').val(response.response.id);
                        updateOvertimeTypeId.val(response.response.type_id);
                        $('#update_overtime_start_date').val(reformatDateForCalendar(response.response.start_date));
                        $('#update_overtime_end_date').val(reformatDateForCalendar(response.response.end_date));
                        $('#update_overtime_description').val(response.response.description);
                        $('#show_overtime_type_name_span').html(response.response.type ? response.response.type.name : '--');
                        $('#show_overtime_status_badge_span').html(response.response.status ? response.response.status.name : '--').removeClass().addClass(`badge badge-${response.response.status ? response.response.status.color : 'secondary'}`);
                        $('#show_overtime_start_date_span').html(reformatDatetimeToDatetimeForHuman(response.response.start_date));
                        $('#show_overtime_end_date_span').html(reformatDatetimeToDatetimeForHuman(response.response.end_date));
                        $('#show_overtime_description_input').val(response.response.description);
                        parseInt(response.response.status_id) === 1 ? EditOvertimeButton.show() : EditOvertimeButton.hide();
                        $('#ShowOvertimeModal').modal('show');
                        $('#loader').hide();
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error('Fazla Mesai Detayları Alınırken Serviste Bir Sorun Oluştu!');
                        $('#loader').hide();
                    }
                });
            } else if (type === 'payment') {
                $('#loader').show();
                $.ajax({
                    type: 'get',
                    url: '{{ route('employee.api.payment.getById') }}',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': token
                    },
                    data: {
                        id: id
                    },
                    success: function (response) {
                        $('#update_payment_id').val(response.response.id);
                        updatePaymentTypeId.val(response.response.type_id);
                        $('#update_payment_date').val(response.response.date);
                        $('#update_payment_amount').val(response.response.amount);
                        $('#update_payment_description').val(response.response.description);
                        $('#show_payment_type_name_span').html(response.response.type ? response.response.type.name : '--');
                        $('#show_payment_status_badge_span').html(response.response.status ? response.response.status.name : '--').removeClass().addClass(`badge badge-${response.response.status ? response.response.status.color : 'secondary'}`);
                        $('#show_payment_date_span').html(reformatDatetimeToDateForHuman(response.response.date));
                        $('#show_payment_amount_span').html(`${response.response.amount} ₺`);
                        $('#show_payment_description_input').val(response.response.description);
                        parseInt(response.response.status_id) === 1 ? EditPaymentButton.show() : EditPaymentButton.hide();
                        $('#ShowPaymentModal').modal('show');
                        $('#loader').hide();
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error('Ödeme Detayları Alınırken Serviste Bir Sorun Oluştu!');
                        $('#loader').hide();
                    }
                });
            } else if (type === 'foodListCheck') {
                $('#loader').show();
                $.ajax({
                    type: 'get',
                    url: '{{ route('employee.api.foodListCheck.getById') }}',
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': token
                    },
                    data: {
                        id: id
                    },
                    success: function (response) {
                        $('#update_food_list_check_id').val(response.response.id);
                        $('#update_food_list_check_food_list_name_span').html(response.response.food_list.name);
                        $('#update_food_list_check_checked_badge_span').html(parseInt(response.response.checked) === 1 ? 'Yiyeceğim' : 'Yemeyeceğim').removeClass().addClass(`badge badge-${parseInt(response.response.checked) === 1 ? 'success' : 'danger'}`);
                        $('#update_food_list_check_checked').val(response.response.checked);
                        $('#update_food_list_check_liked').val(response.response.liked);
                        $('#update_food_list_check_count').val(response.response.count);
                        $('#update_food_list_check_description').val(response.response.description);
                        $('#UpdateFoodListCheckModal').modal('show');
                        $('#loader').hide();
                    },
                    error: function (error) {
                        console.log(error);
                        toastr.error('Yemek Detayları Alınırken Serviste Bir Sorun Oluştu!');
                        $('#loader').hide();
                    }
                });
            } else {
                console.log(info.event._def);
            }
        },

        datesSet: function (info) {
            getShifts();
            getPermits();
            getOvertimes();
            getPayments();
            getFoodListChecks();
        },

        events: [],
    });

    calendar.render();

    function getPermitTypes() {
        $.ajax({
            type: 'get',
            url: '{{ route('employee.api.permitType.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                createPermitTypeId.empty();
                updatePermitTypeId.empty();
                $.each(response.response, function (i, permitType) {
                    createPermitTypeId.append(`<option value="${permitType.id}">${permitType.name}</option>`);
                    updatePermitTypeId.append(`<option value="${permitType.id}">${permitType.name}</option>`);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('İzin Türleri Alınırken Serviste Bir Sorun Oluştu.');
            }
        });
    }

    function getOvertimeTypes() {
        $.ajax({
            type: 'get',
            url: '{{ route('employee.api.overtimeType.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                createOvertimeTypeId.empty();
                updateOvertimeTypeId.empty();
                $.each(response.response, function (i, overtimeType) {
                    createOvertimeTypeId.append(`<option value="${overtimeType.id}">${overtimeType.name}</option>`);
                    updateOvertimeTypeId.append(`<option value="${overtimeType.id}">${overtimeType.name}</option>`);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Fazla Mesai Türleri Alınırken Serviste Bir Sorun Oluştu.');
            }
        });
    }

    function getPaymentTypes() {
        $.ajax({
            type: 'get',
            url: '{{ route('employee.api.paymentType.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                createPaymentTypeId.empty();
                updatePaymentTypeId.empty();
                $.each(response.response, function (i, paymentType) {
                    createPaymentTypeId.append(`<option value="${paymentType.id}">${paymentType.name}</option>`);
                    updatePaymentTypeId.append(`<option value="${paymentType.id}">${paymentType.name}</option>`);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Ödeme Türleri Alınırken Serviste Bir Sorun Oluştu.');
            }
        });
    }

    function getShifts() {
        var startDate = reformatDatetime(calendar.currentData.dateProfile.activeRange.start);
        var endDate = reformatDatetime(calendar.currentData.dateProfile.activeRange.end);

        $.ajax({
            type: 'get',
            url: '{{ route('employee.api.shift.getDateBetweenByEmployeeId') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                startDate: startDate,
                endDate: endDate,
            },
            success: function (response) {
                $.each(calendar.getEvents(), function (i, event) {
                    if (event._def.extendedProps.type === 'shift') {
                        event.remove();
                    }
                });
                calendar.addEventSource({
                    events: $.map(response.response, function (shift) {
                        return {
                            _id: shift.id,
                            id: shift.id,
                            title: `Vardiya`,
                            start: reformatDateForCalendar(shift.start_date),
                            end: reformatDateForCalendar(shift.end_date),
                            type: 'shift',
                            classNames: `bg-primary text-white cursor-pointer ms-1 me-1`,
                            backgroundColor: 'white',
                            shift_id: `${shift.id}`
                        };
                    }),
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Vardiya Listesi Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getPermits() {
        var startDate = reformatDatetime(calendar.currentData.dateProfile.activeRange.start);
        var endDate = reformatDatetime(calendar.currentData.dateProfile.activeRange.end);

        $.ajax({
            type: 'get',
            url: '{{ route('employee.api.permit.getDateBetween') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                startDate: startDate,
                endDate: endDate,
            },
            success: function (response) {
                $.each(calendar.getEvents(), function (i, event) {
                    if (event._def.extendedProps.type === 'permit') {
                        event.remove();
                    }
                });
                calendar.addEventSource({
                    events: $.map(response.response, function (permit) {
                        return {
                            _id: permit.id,
                            id: permit.id,
                            title: `İzin`,
                            start: reformatDateForCalendar(permit.start_date),
                            end: reformatDateForCalendar(permit.end_date),
                            type: 'permit',
                            classNames: `bg-${permit.status.color} text-white cursor-pointer ms-1 me-1`,
                            backgroundColor: 'white',
                            permit_id: `${permit.id}`
                        };
                    }),
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('İzin Listesi Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getOvertimes() {
        var startDate = reformatDatetime(calendar.currentData.dateProfile.activeRange.start);
        var endDate = reformatDatetime(calendar.currentData.dateProfile.activeRange.end);

        $.ajax({
            type: 'get',
            url: '{{ route('employee.api.overtime.getDateBetween') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                startDate: startDate,
                endDate: endDate,
            },
            success: function (response) {
                $.each(calendar.getEvents(), function (i, event) {
                    if (event._def.extendedProps.type === 'overtime') {
                        event.remove();
                    }
                });
                calendar.addEventSource({
                    events: $.map(response.response, function (overtime) {
                        return {
                            _id: overtime.id,
                            id: overtime.id,
                            title: `Mesai`,
                            start: reformatDateForCalendar(overtime.start_date),
                            end: reformatDateForCalendar(overtime.end_date),
                            type: 'overtime',
                            classNames: `bg-${overtime.status.color} text-white cursor-pointer ms-1 me-1`,
                            backgroundColor: 'white',
                            overtime_id: `${overtime.id}`
                        };
                    }),
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Fazla Mesai Listesi Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getPayments() {
        var startDate = reformatDatetime(calendar.currentData.dateProfile.activeRange.start);
        var endDate = reformatDatetime(calendar.currentData.dateProfile.activeRange.end);

        $.ajax({
            type: 'get',
            url: '{{ route('employee.api.payment.getDateBetween') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                startDate: startDate,
                endDate: endDate,
            },
            success: function (response) {
                $.each(calendar.getEvents(), function (i, event) {
                    if (event._def.extendedProps.type === 'payment') {
                        event.remove();
                    }
                });
                calendar.addEventSource({
                    events: $.map(response.response, function (payment) {
                        return {
                            _id: payment.id,
                            id: payment.id,
                            title: `Ödeme`,
                            start: reformatDateForCalendar(payment.date),
                            end: reformatDateForCalendar(payment.date),
                            type: 'payment',
                            classNames: `bg-${payment.status.color} text-white cursor-pointer ms-1 me-1`,
                            backgroundColor: 'white',
                            payment_id: `${payment.id}`
                        };
                    }),
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Ödeme Listesi Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getFoodListChecks() {
        var startDate = reformatDatetime(calendar.currentData.dateProfile.activeRange.start);
        var endDate = reformatDatetime(calendar.currentData.dateProfile.activeRange.end);

        $.ajax({
            type: 'get',
            url: '{{ route('employee.api.foodListCheck.getDateBetween') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                startDate: startDate,
                endDate: endDate,
            },
            success: function (response) {
                $.each(calendar.getEvents(), function (i, event) {
                    if (event._def.extendedProps.type === 'foodListCheck') {
                        event.remove();
                    }
                });
                calendar.addEventSource({
                    events: $.map(response.response, function (foodListCheck) {
                        return foodListCheck.food_list ? {
                            _id: foodListCheck.id,
                            id: foodListCheck.id,
                            title: `${foodListCheck.food_list.name}`,
                            start: reformatDateForCalendar(foodListCheck.food_list.date),
                            end: reformatDateForCalendar(foodListCheck.food_list.date),
                            type: 'foodListCheck',
                            classNames: `bg-${foodListCheck.checked == null ? 'warning' : (foodListCheck.checked === 1 ? 'success' : 'danger')} text-white cursor-pointer ms-1 me-1`,
                            backgroundColor: 'white',
                            food_list_check_id: `${foodListCheck.id}`
                        } : {};
                    }),
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Yemek Listesi Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getMarketPayments() {
        $.ajax({
            type: 'get',
            url: '{{ route('employee.api.getMarketPayments') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                var income = 0;
                var expense = 0;

                $.each(response.response, function (i, marketPayment) {
                    if (parseInt(marketPayment.direction) === 0) {
                        income += marketPayment.amount;
                    } else if (parseInt(marketPayment.direction) === 1 && parseInt(marketPayment.completed) === 1) {
                        expense += marketPayment.amount;
                    }
                });

                $('#employeeBalanceSpan').text(`${reformatNumberToMoney(income - expense)} ₺`);
            },
            error: function (error) {
                console.log(error);
                toastr.error('Market Ödemeleri Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    getPermits();
    getOvertimes();
    getPayments();
    getFoodListChecks();
    getMarketPayments();
    getPermitTypes();
    getOvertimeTypes();
    getPaymentTypes();

    function createPermit() {
        createPermitTypeId.val('');
        $('#create_permit_start_date').val('');
        $('#create_permit_end_date').val('');
        $('#create_permit_description').val('');
        $('#CreatePermitModal').modal('show');
    }

    function updatePermit() {
        $('#ShowPermitModal').modal('hide');
        $('#UpdatePermitModal').modal('show');
    }

    function createOvertime() {
        createOvertimeTypeId.val('');
        $('#create_overtime_start_date').val('');
        $('#create_overtime_end_date').val('');
        $('#create_overtime_description').val('');
        $('#CreateOvertimeModal').modal('show');
    }

    function updateOvertime() {
        $('#ShowOvertimeModal').modal('hide');
        $('#UpdateOvertimeModal').modal('show');
    }

    function createPayment() {
        createPaymentTypeId.val('');
        $('#create_payment_date').val('');
        $('#create_payment_amount').val('');
        $('#create_payment_description').val('');
        $('#CreatePaymentModal').modal('show');
    }

    function updatePayment() {
        $('#ShowPaymentModal').modal('hide');
        $('#UpdatePaymentModal').modal('show');
    }

    function createMarketPayment() {
        $('#create_market_payment_amount').val('');
        $('#CreateMarketPaymentModal').modal('show');
    }

    CreatePermitButton.click(function () {
        var typeId = createPermitTypeId.val();
        var startDate = $('#create_permit_start_date').val();
        var endDate = $('#create_permit_end_date').val();
        var description = $('#create_permit_description').val();

        if (!typeId) {
            toastr.warning('İzin Türü Seçimi Zorunludur.');
        } else if (!startDate) {
            toastr.warning('Başlangıç Tarihi Seçimi Zorunludur.');
        } else if (!endDate) {
            toastr.warning('Bitiş Tarihi Seçimi Zorunludur.');
        } else if (!description) {
            toastr.warning('Açıklama Zorunludur.');
        } else {
            $('#loader').show();
            $('#CreatePermitModal').modal('hide');
            $.ajax({
                type: 'post',
                url: '{{ route('employee.api.permit.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    typeId: typeId,
                    startDate: startDate,
                    endDate: endDate,
                    description: description,
                },
                success: function () {
                    toastr.success('İzin Talebiniz Başarıyla Oluşturuldu.');
                    getPermits();
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('İzin Talebi Oluşturulurken Serviste Bir Sorun Oluştu.');
                    $('#loader').hide();
                }
            });
        }
    });

    UpdatePermitButton.click(function () {
        var id = $('#update_permit_id').val();
        var typeId = updatePermitTypeId.val();
        var startDate = $('#update_permit_start_date').val();
        var endDate = $('#update_permit_end_date').val();
        var description = $('#update_permit_description').val();

        if (!typeId) {
            toastr.warning('İzin Türü Seçimi Zorunludur.');
        } else if (!startDate) {
            toastr.warning('Başlangıç Tarihi Seçimi Zorunludur.');
        } else if (!endDate) {
            toastr.warning('Bitiş Tarihi Seçimi Zorunludur.');
        } else if (!description) {
            toastr.warning('Açıklama Zorunludur.');
        } else {
            $('#loader').show();
            $('#UpdatePermitModal').modal('hide');
            $.ajax({
                type: 'put',
                url: '{{ route('employee.api.permit.update') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    typeId: typeId,
                    startDate: startDate,
                    endDate: endDate,
                    description: description,
                },
                success: function () {
                    toastr.success('İzin Talebiniz Başarıyla Güncellendi.');
                    getPermits();
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('İzin Talebi Güncellenirken Serviste Bir Sorun Oluştu.');
                    $('#loader').hide();
                }
            });
        }
    });

    CreateOvertimeButton.click(function () {
        var typeId = createOvertimeTypeId.val();
        var startDate = $('#create_overtime_start_date').val();
        var endDate = $('#create_overtime_end_date').val();
        var description = $('#create_overtime_description').val();

        if (!typeId) {
            toastr.warning('Fazla Mesai Türü Seçimi Zorunludur.');
        } else if (!startDate) {
            toastr.warning('Başlangıç Tarihi Seçimi Zorunludur.');
        } else if (!endDate) {
            toastr.warning('Bitiş Tarihi Seçimi Zorunludur.');
        } else if (!description) {
            toastr.warning('Açıklama Zorunludur.');
        } else {
            $('#loader').show();
            $('#CreateOvertimeModal').modal('hide');
            $.ajax({
                type: 'post',
                url: '{{ route('employee.api.overtime.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    typeId: typeId,
                    startDate: startDate,
                    endDate: endDate,
                    description: description,
                },
                success: function () {
                    toastr.success('Fazla Mesai Talebiniz Başarıyla Oluşturuldu.');
                    getOvertimes();
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Fazla Mesai Talebi Oluşturulurken Serviste Bir Sorun Oluştu.');
                    $('#loader').hide();
                }
            });
        }
    });

    UpdateOvertimeButton.click(function () {
        var id = $('#update_overtime_id').val();
        var typeId = updateOvertimeTypeId.val();
        var startDate = $('#update_overtime_start_date').val();
        var endDate = $('#update_overtime_end_date').val();
        var description = $('#update_overtime_description').val();

        if (!typeId) {
            toastr.warning('Fazla Mesai Türü Seçimi Zorunludur.');
        } else if (!startDate) {
            toastr.warning('Başlangıç Tarihi Seçimi Zorunludur.');
        } else if (!endDate) {
            toastr.warning('Bitiş Tarihi Seçimi Zorunludur.');
        } else if (!description) {
            toastr.warning('Açıklama Zorunludur.');
        } else {
            $('#loader').show();
            $('#UpdateOvertimeModal').modal('hide');
            $.ajax({
                type: 'put',
                url: '{{ route('employee.api.overtime.update') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    typeId: typeId,
                    startDate: startDate,
                    endDate: endDate,
                    description: description,
                },
                success: function () {
                    toastr.success('Fazla Mesai Talebiniz Başarıyla Güncellendi.');
                    getOvertimes();
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Fazla Mesai Talebi Güncellenirken Serviste Bir Sorun Oluştu.');
                    $('#loader').hide();
                }
            });
        }
    });

    CreatePaymentButton.click(function () {
        var typeId = createPaymentTypeId.val();
        var date = $('#create_payment_date').val();
        var amount = $('#create_payment_amount').val();
        var description = $('#create_payment_description').val();

        if (!typeId) {
            toastr.warning('Ödeme Türü Seçimi Zorunludur.');
        } else if (!date) {
            toastr.warning('Tarih Seçimi Zorunludur.');
        } else if (!amount) {
            toastr.warning('İstenilen Miktar Boş Olamaz.');
        } else if (!description) {
            toastr.warning('Açıklama Zorunludur.');
        } else {
            $('#loader').show();
            $('#CreatePaymentModal').modal('hide');
            $.ajax({
                type: 'post',
                url: '{{ route('employee.api.payment.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    typeId: typeId,
                    date: date,
                    amount: amount,
                    description: description,
                },
                success: function () {
                    toastr.success('Ödeme Talebiniz Başarıyla Oluşturuldu.');
                    getPayments();
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Ödeme Talebi Oluşturulurken Serviste Bir Sorun Oluştu.');
                    $('#loader').hide();
                }
            });
        }
    });

    UpdatePaymentButton.click(function () {
        var id = $('#update_payment_id').val();
        var typeId = updatePaymentTypeId.val();
        var date = $('#update_payment_date').val();
        var amount = $('#update_payment_amount').val();
        var description = $('#update_payment_description').val();

        if (!typeId) {
            toastr.warning('Ödeme Türü Seçimi Zorunludur.');
        } else if (!date) {
            toastr.warning('Tarih Seçimi Zorunludur.');
        } else if (!amount) {
            toastr.warning('İstenilen Miktar Boş Olamaz.');
        } else if (!description) {
            toastr.warning('Açıklama Zorunludur.');
        } else {
            $('#loader').show();
            $('#UpdatePaymentModal').modal('hide');
            $.ajax({
                type: 'put',
                url: '{{ route('employee.api.payment.update') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    typeId: typeId,
                    date: date,
                    amount: amount,
                    description: description,
                },
                success: function () {
                    toastr.success('Ödeme Talebiniz Başarıyla Güncellendi.');
                    getPayments();
                    $('#loader').hide();
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Ödeme Talebi Güncellenirken Serviste Bir Sorun Oluştu.');
                    $('#loader').hide();
                }
            });
        }
    });

    UpdateFoodListCheckButton.click(function () {
        var id = $('#update_food_list_check_id').val();
        var checked = $('#update_food_list_check_checked').val();
        var liked = $('#update_food_list_check_liked').val();
        var count = $('#update_food_list_check_count').val();
        var description = $('#update_food_list_check_description').val();

        $('#loader').show();

        $.ajax({
            type: 'put',
            url: '{{ route('employee.api.foodListCheck.update') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
                checked: checked,
                liked: liked,
                count: count,
                description: description,
            },
            success: function () {
                $('#update_food_list_check_checked_badge_span').html(parseInt(checked) === 1 ? 'Yiyeceğim' : 'Yemeyeceğim').removeClass().addClass(`badge badge-${parseInt(checked) === 1 ? 'success' : 'danger'}`);
                $('#loader').hide();
                getFoodListChecks();
                toastr.success('Başarıyla Güncellendi.');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Güncellenirken Serviste Bir Sorun Oluştu.');
                $('#loader').hide();
            }
        });
    });

    CreateMarketPaymentButton.click(function () {
        var amount = $('#create_market_payment_amount').val();

        if (!amount) {
            toastr.warning('Ödeme tutarı Boş Olamaz.');
        } else {
            $.ajax({
                type: 'post',
                url: '{{ route('employee.api.marketPayment.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    amount: amount,
                },
                success: function (response) {
                    $('#qrcode').empty().qrcode(response.response.code);
                    $('#pinCode').html(`Pin Kodu: ${response.response.code}`);
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Ödeme Yapılırken Serviste Bir Sorun Oluştu.');
                }
            });
        }
    });

    EditPermitButton.click(function () {
        updatePermit();
    });

    EditOvertimeButton.click(function () {
        updateOvertime();
    });

    EditPaymentButton.click(function () {
        updatePayment();
    });

    var mainMissions = $('#mainMissions');
    var additionalCentralMissions = $('#additionalCentralMissions');

    function getMainCentralMissions() {
        $.ajax({
            type: 'get',
            url: '{{ route('employee.api.centralMission.getByRelation') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                relationType: 'App\\Models\\Eloquent\\Employee',
                relationId: '{{ auth()->id() }}',
                pageIndex: 0,
                pageSize: 1000,
                typeIds: [1],
            },
            success: function (response) {
                mainMissions.empty();
                $.each(response.response.centralMissions, function (i, centralMission) {
                    mainMissions.append(`
                    <div class="col-xl-3 mb-5">
                        <div class="card card-custom bg-primary card-stretch gutter-b">
                            <a target="_blank" class="card-body text-center cursor-pointer" onclick="centralMissionDiagram(${centralMission.id})">
                                <span class="fw-bolder fs-4 text-white">${centralMission.title}</span>
                                <hr class="text-white">
                                <span class="font-weight-bold text-white">Başlangıç: ${reformatDatetimeToDateForHuman(centralMission.start_date)}</span>
                                <br>
                                <span class="font-weight-bold text-white">Bitiş: ${centralMission.end_date ? reformatDatetimeToDateForHuman(centralMission.end_date) : '--'}</span>
                            </a>
                        </div>
                    </div>
                    `);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Ana Görev Listesi Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getAdditionalCentralMissions() {
        $.ajax({
            type: 'get',
            url: '{{ route('employee.api.centralMission.getByRelation') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                relationType: 'App\\Models\\Eloquent\\Employee',
                relationId: '{{ auth()->id() }}',
                pageIndex: 0,
                pageSize: 1000,
                typeIds: [2],
            },
            success: function (response) {
                additionalCentralMissions.empty();
                $.each(response.response.centralMissions, function (i, centralMission) {
                    additionalCentralMissions.append(`
                    <tr>
                        <td>
                            <a class="cursor-pointer fw-bolder" onclick="centralMissionDiagram(${centralMission.id})">${centralMission.title ?? ''}</a>
                        </td>
                        <td>
                            ${centralMission.status ? centralMission.status.name : ''}
                        </td>
                        <td>
                            ${centralMission.start_date ? reformatDatetimeToDateForHuman(centralMission.start_date) : ''}
                        </td>
                        <td>
                            ${centralMission.end_date ? reformatDatetimeToDateForHuman(centralMission.end_date) : ''}
                        </td>
                    </tr>
                    `);
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Ek Görev Listesi Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    getMainCentralMissions();
    getAdditionalCentralMissions();

    function centralMissionDiagram(id) {
        $('#loader').show();
        $.ajax({
            type: 'get',
            url: '{{ route('employee.api.centralMission.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                $('#loader').hide();
                var diagram = $("#diagram").ejDiagram("instance");
                var data = JSON.parse(response.response.diagram);
                diagram.load(data ?? {});
                $('#diagram_canvas_svg').click();
                $('#DiagramModal').modal('show');
            },
            error: function (error) {
                $('#loader').hide();
                console.log(error);
                toastr.error('Görev Verileri Alınırken Serviste Hata Oluştu!');
            }
        });
    }

</script>
