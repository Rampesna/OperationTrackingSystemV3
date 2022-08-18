<script src="{{ asset('assets/ejDiagram/ej.web.all.min.js') }}"></script>
<script>

    var SaveDiagramButton = $('#SaveDiagramButton');

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

            SaveDiagramButton.click(function () {
                var diagram = $("#diagram").ejDiagram("instance");
                var savingJson = diagram.save();
                var json_to_text = JSON.stringify(savingJson, null, 2);

                console.log(json_to_text);
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

    var updatePermission = `{{ checkUserPermission(159, $userPermissions) ? 'true' : 'false' }}`;
    var updateDiagramPermission = `{{ checkUserPermission(160, $userPermissions) ? 'true' : 'false' }}`;
    var deletePermission = `{{ checkUserPermission(161, $userPermissions) ? 'true' : 'false' }}`;

    $(document).ready(function () {
        $('#loader').hide();
    });

    var centralMissionsRow = $('#centralMissions');

    var page = $('#page');
    var pageUpButton = $('#pageUp');
    var pageDownButton = $('#pageDown');
    var pageSizeSelector = $('#pageSize');

    var relationTypeFilter = $('#relationTypeFilter');
    var relationIdFilter = $('#relationIdFilter');
    var typeIdsFilter = $('#typeIdsFilter');
    var statusIdsFilter = $('#statusIdsFilter');

    var CreateCentralMissionButton = $('#CreateCentralMissionButton');
    var UpdateCentralMissionButton = $('#UpdateCentralMissionButton');
    var DeleteCentralMissionButton = $('#DeleteCentralMissionButton');
    var UpdateDiagramButton = $('#UpdateDiagramButton');

    var createCentralMissionTypeId = $('#create_central_mission_type_id');
    var createCentralMissionStatusId = $('#create_central_mission_status_id');

    var updateCentralMissionTypeId = $('#update_central_mission_type_id');
    var updateCentralMissionStatusId = $('#update_central_mission_status_id');

    var GetCentralMissionsButton = $('#GetCentralMissionsButton');

    relationTypeFilter.change(function () {
        if (relationTypeFilter.val() === 'App\\Models\\Eloquent\\Employee') {
            $.ajax({
                type: 'get',
                url: '{{ route('user.api.employee.getByCompanyIds') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    companyIds: SelectedCompanies.val(),
                    pageIndex: 0,
                    pageSize: 1000,
                    leave: 0,
                },
                success: function (response) {
                    relationIdFilter.empty();
                    $.each(response.response.employees, function (i, employee) {
                        relationIdFilter.append(
                            $('<option>', {
                                value: employee.id,
                                text: employee.name
                            })
                        );
                    });
                    relationIdFilter.val('');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Görevli Listesi Alınırken Serviste Bir Sorun Oluştu!');
                }
            });
        } else if (relationTypeFilter.val() === 'App\\Models\\Eloquent\\User') {
            $.ajax({
                type: 'get',
                url: '{{ route('user.api.user.getAll') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    companyIds: SelectedCompanies.val(),
                    pageIndex: 0,
                    pageSize: 1000,
                    leave: 0,
                },
                success: function (response) {
                    relationIdFilter.empty();
                    $.each(response.response, function (i, user) {
                        relationIdFilter.append(
                            $('<option>', {
                                value: user.id,
                                text: user.name
                            })
                        );
                    });
                    relationIdFilter.val('');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Görevli Listesi Alınırken Serviste Bir Sorun Oluştu!');
                }
            });
        } else {
            toastr.warning('Geçersiz Bir Görevli Türü Seçtiniz!');
        }
    });

    function createCentralMission() {
        var relationType = relationTypeFilter.val();
        var relationId = relationIdFilter.val();

        if (!relationType) {
            toastr.warning('Görevli Türü Seçmelisiniz!');
        } else if (!relationId) {
            toastr.warning('Görevli Seçmelisiniz!');
        } else {
            createCentralMissionTypeId.val('').trigger('change');
            createCentralMissionStatusId.val('').trigger('change');
            $('#create_central_mission_title').val('');
            $('#create_central_mission_description').val('');
            $('#create_central_mission_start_date').val('');
            $('#create_central_mission_end_date').val('');
            $('#CreateCentralMissionModal').modal('show');
        }
    }

    function updateCentralMission(id) {
        $('#update_central_mission_id').val(id);
        $('#loader').show();
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.centralMission.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                updateCentralMissionTypeId.val(response.response.type_id).trigger('change');
                updateCentralMissionStatusId.val(response.response.status_id).trigger('change');
                $('#update_central_mission_title').val(response.response.title);
                $('#update_central_mission_description').val(response.response.description);
                $('#update_central_mission_start_date').val(response.response.start_date ? response.response.start_date : '');
                $('#update_central_mission_end_date').val(response.response.end_date ? response.response.end_date : '');
                $('#UpdateCentralMissionModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Görev Verileri Alınırken Serviste Bir Sorun Oluştu!');
                $('#loader').hide();
            }
        });
    }

    function deleteCentralMission(id) {
        $('#delete_central_mission_id').val(id);
        $('#DeleteCentralMissionModal').modal('show');
    }

    function centralMissionDiagram(id) {
        $('#loader').show();
        $('#update_diagram_id').val(id);
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.centralMission.getById') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function (response) {
                var diagram = $("#diagram").ejDiagram("instance");
                var data = JSON.parse(response.response.diagram);
                diagram.load(data ?? {});
                $('#diagram_canvas_svg').click();
                $('#DiagramModal').modal('show');
                $('#loader').hide();
            },
            error: function (error) {
                console.log(error);
                toastr.error('Görev Verileri Alınırken Serviste Hata Oluştu!');
                $('#loader').hide();
            }
        });
    }

    function getCentralMissionTypes() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.centralMissionType.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                typeIdsFilter.empty();
                createCentralMissionTypeId.empty();
                updateCentralMissionTypeId.empty();
                $.each(response.response, function (i, centralMissionType) {
                    typeIdsFilter.append(
                        $('<option>', {
                            value: centralMissionType.id,
                            text: centralMissionType.name
                        })
                    );
                    createCentralMissionTypeId.append(
                        $('<option>', {
                            value: centralMissionType.id,
                            text: centralMissionType.name
                        })
                    );
                    updateCentralMissionTypeId.append(
                        $('<option>', {
                            value: centralMissionType.id,
                            text: centralMissionType.name
                        })
                    );
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Görev Türleri Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    function getCentralMissionStatuses() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.centralMissionStatus.getAll') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {},
            success: function (response) {
                statusIdsFilter.empty();
                createCentralMissionStatusId.empty();
                updateCentralMissionStatusId.empty();
                $.each(response.response, function (i, centralMissionStatus) {
                    statusIdsFilter.append(
                        $('<option>', {
                            value: centralMissionStatus.id,
                            text: centralMissionStatus.name
                        })
                    );
                    createCentralMissionStatusId.append(
                        $('<option>', {
                            value: centralMissionStatus.id,
                            text: centralMissionStatus.name
                        })
                    );
                    updateCentralMissionStatusId.append(
                        $('<option>', {
                            value: centralMissionStatus.id,
                            text: centralMissionStatus.name
                        })
                    );
                });
            },
            error: function (error) {
                console.log(error);
                toastr.error('Görev Durumları Alınırken Serviste Bir Sorun Oluştu!');
            }
        });
    }

    getCentralMissionTypes();
    getCentralMissionStatuses();

    function changePage(newPage) {
        if (newPage === 1) {
            pageDownButton.attr('disabled', true);
        } else {
            pageDownButton.attr('disabled', false);
        }

        page.html(newPage);
        getCentralMissionsByRelation();
    }

    pageUpButton.click(function () {
        changePage(parseInt(page.html()) + 1);
    });

    pageDownButton.click(function () {
        changePage(parseInt(page.html()) - 1);
    });

    pageSizeSelector.change(function () {
        changePage(1);
    });

    function getCentralMissionsByRelation() {
        var relationType = relationTypeFilter.val();
        var relationId = relationIdFilter.val();
        var pageIndex = parseInt(page.html()) - 1;
        var pageSize = pageSizeSelector.val();
        var typeIds = typeIdsFilter.val();
        var statusIds = statusIdsFilter.val();

        if (!relationType) {
            toastr.warning('Görevli Türü Seçmediniz!');
        } else if (!relationId) {
            toastr.warning('Görevli Seçmediniz!');
        } else {
            $.ajax({
                type: 'get',
                url: '{{ route('user.api.centralMission.getByRelation') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    relationType: relationType,
                    relationId: relationId,
                    pageIndex: pageIndex,
                    pageSize: pageSize,
                    typeIds: typeIds,
                    statusIds: statusIds,
                },
                success: function (response) {
                    centralMissionsRow.empty();
                    $.each(response.response.centralMissions, function (i, centralMission) {
                        centralMissionsRow.append(`
                        <tr>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary btn-icon btn-sm" type="button" id="${centralMission.id}_Dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-th"></i>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="${centralMission.id}_Dropdown" style="width: 175px">
                                        ${updatePermission === 'true' ? `
                                        <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="updateCentralMission(${centralMission.id})" title="Düzenle"><i class="fas fa-edit me-2 text-primary"></i> <span class="text-dark">Düzenle</span></a>
                                        ` : ``}
                                        ${updateDiagramPermission === 'true' ? `
                                        <a class="dropdown-item cursor-pointer mb-2 py-3 ps-6" onclick="centralMissionDiagram(${centralMission.id})" title="Görev Diyagramı"><i class="fas fa-project-diagram me-2 text-info"></i> <span class="text-dark">Görev Diyagramı</span></a>
                                        ` : ``}
                                        ${deletePermission === 'true' ? `
                                        <hr class="text-muted">
                                        <a class="dropdown-item cursor-pointer py-3 ps-6" onclick="deleteCentralMission(${centralMission.id})" title="Sil"><i class="fas fa-trash-alt me-3 text-danger"></i> <span class="text-dark">Sil</span></a>
                                        ` : `` }
                                    </div>
                                </div>
                            </td>
                            <td>
                                ${centralMission.type ? centralMission.type.name : ''}
                            </td>
                            <td>
                                ${centralMission.title ?? ''}
                            </td>
                            <td>
                                ${centralMission.start_date ? reformatDatetimeToDateForHuman(centralMission.start_date) : ''}
                            </td>
                            <td>
                                ${centralMission.end_date ? reformatDatetimeToDateForHuman(centralMission.end_date) : ''}
                            </td>
                            <td>
                                ${centralMission.status ? centralMission.status.name : ''}
                            </td>
                        </tr>
                        `);
                    });
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Görev Listesi Alınırken Serviste Bir Sorun Oluştu!');
                }
            });
        }
    }

    GetCentralMissionsButton.click(function () {
        getCentralMissionsByRelation();
    });

    CreateCentralMissionButton.click(function () {
        var typeId = createCentralMissionTypeId.val();
        var statusId = createCentralMissionStatusId.val();
        var relationId = relationIdFilter.val();
        var relationType = relationTypeFilter.val();
        var title = $('#create_central_mission_title').val();
        var description = $('#create_central_mission_description').val();
        var startDate = $('#create_central_mission_start_date').val();
        var endDate = $('#create_central_mission_end_date').val();

        if (!typeId) {
            toastr.warning('Görev Türü Seçmediniz!');
        } else if (!statusId) {
            toastr.warning('Görev Durumu Seçmediniz!');
        } else if (!relationType) {
            toastr.warning('Görevli Türü Seçmediniz!');
        } else if (!relationId) {
            toastr.warning('Görevli Seçmediniz!');
        } else if (!title) {
            toastr.warning('Görev Başlığı Girmediniz!');
        } else {
            CreateCentralMissionButton.attr('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'post',
                url: '{{ route('user.api.centralMission.create') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    typeId: typeId,
                    statusId: statusId,
                    relationId: relationId,
                    relationType: relationType,
                    title: title,
                    description: description,
                    startDate: startDate,
                    endDate: endDate,
                },
                success: function () {
                    toastr.success('Görevlendirme Başarıyla Oluşturuldu!');
                    changePage(1);
                    $('#CreateCentralMissionModal').modal('hide');
                    CreateCentralMissionButton.attr('disabled', false).html('Oluştur');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Görevlendirme Oluşturulurken Serviste Bir Sorun Oluştu!');
                    CreateCentralMissionButton.attr('disabled', false).html('Oluştur');
                }
            });
        }
    });

    UpdateCentralMissionButton.click(function () {
        var id = $('#update_central_mission_id').val();
        var typeId = updateCentralMissionTypeId.val();
        var statusId = updateCentralMissionStatusId.val();
        var relationId = relationIdFilter.val();
        var relationType = relationTypeFilter.val();
        var title = $('#update_central_mission_title').val();
        var description = $('#update_central_mission_description').val();
        var startDate = $('#update_central_mission_start_date').val();
        var endDate = $('#update_central_mission_end_date').val();

        if (!typeId) {
            toastr.warning('Görev Türü Seçmediniz!');
        } else if (!statusId) {
            toastr.warning('Görev Durumu Seçmediniz!');
        } else if (!relationType) {
            toastr.warning('Görevli Türü Seçmediniz!');
        } else if (!relationId) {
            toastr.warning('Görevli Seçmediniz!');
        } else if (!title) {
            toastr.warning('Görev Başlığı Girmediniz!');
        } else {
            UpdateCentralMissionButton.attr('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
            $.ajax({
                type: 'put',
                url: '{{ route('user.api.centralMission.update') }}',
                headers: {
                    'Accept': 'application/json',
                    'Authorization': token
                },
                data: {
                    id: id,
                    typeId: typeId,
                    statusId: statusId,
                    relationId: relationId,
                    relationType: relationType,
                    title: title,
                    description: description,
                    startDate: startDate,
                    endDate: endDate,
                },
                success: function () {
                    toastr.success('Görevlendirme Başarıyla Güncellendi!');
                    changePage(parseInt(page.html()));
                    $('#UpdateCentralMissionModal').modal('hide');
                    UpdateCentralMissionButton.attr('disabled', false).html('Güncelle');
                },
                error: function (error) {
                    console.log(error);
                    toastr.error('Görevlendirme Güncellenirken Serviste Bir Sorun Oluştu!');
                    UpdateCentralMissionButton.attr('disabled', false).html('Güncelle');
                }
            });
        }
    });

    UpdateDiagramButton.click(function () {
        var id = $('#update_diagram_id').val();
        var diagramSelector = $("#diagram").ejDiagram("instance");
        var diagramJson = diagramSelector.save();
        var diagram = JSON.stringify(diagramJson, null, 2);
        UpdateDiagramButton.attr('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
        $.ajax({
            type: 'put',
            url: '{{ route('user.api.centralMission.updateDiagram') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
                diagram: diagram
            },
            success: function () {
                toastr.success('Görevlendirme Diyagramı Başarıyla Güncellendi!');
                UpdateDiagramButton.attr('disabled', false).html('Güncelle');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Görevlendirme Diyagramı Güncellenirken Serviste Bir Sorun Oluştu!');
                UpdateDiagramButton.attr('disabled', false).html('Güncelle');
            }
        });
    });

    DeleteCentralMissionButton.click(function () {
        var id = $('#delete_central_mission_id').val();
        DeleteCentralMissionButton.attr('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
        $.ajax({
            type: 'delete',
            url: '{{ route('user.api.centralMission.delete') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                id: id,
            },
            success: function () {
                toastr.success('Görevlendirme Başarıyla Silindi!');
                changePage(parseInt(page.html()));
                $('#DeleteCentralMissionModal').modal('hide');
                DeleteCentralMissionButton.attr('disabled', false).html('Sil');
            },
            error: function (error) {
                console.log(error);
                toastr.error('Görevlendirme Silinirken Serviste Bir Sorun Oluştu!');
                DeleteCentralMissionButton.attr('disabled', false).html('Sil');
            }
        });
    });

</script>
