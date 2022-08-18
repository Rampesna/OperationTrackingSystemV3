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

    var mainMissions = $('#mainMissions');
    var additionalCentralMissions = $('#additionalCentralMissions');

    var applicationFilterer = $('#application_filter');

    applicationFilterer.keyup(function () {
        var keyword = $(this).val();
        var applications = $('.application');

        if (!keyword) {
            applications.show();
        } else {
            $.each(applications, function (i, application) {
                var applicationName = $(this).data('app-name');
                if (applicationName.toLowerCase().indexOf(keyword.toLowerCase()) === -1) {
                    $(application).hide();
                } else {
                    $(application).show();
                }
            });
        }
    });

    function getMainCentralMissions() {
        $.ajax({
            type: 'get',
            url: '{{ route('user.api.centralMission.getByRelation') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                relationType: 'App\\Models\\Eloquent\\User',
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
            url: '{{ route('user.api.centralMission.getByRelation') }}',
            headers: {
                'Accept': 'application/json',
                'Authorization': token
            },
            data: {
                relationType: 'App\\Models\\Eloquent\\User',
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
            url: '{{ route('user.api.centralMission.getById') }}',
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
