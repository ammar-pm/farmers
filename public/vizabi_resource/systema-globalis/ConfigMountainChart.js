var ConfigMountainChart = {
  "state": {
    "time": {
      "value": "2015",
      "dim": "time"
    },
    "entities": {
      "dim": "geo",
      "filter": {
        "geo": {"un_state": true}
      },
      "show": {}
    },
    "entities_colorlegend": {     
      "dim": "world_4region"
    },
    "marker": {
      "space": ["entities", "time"],
      "opacityRegular": 0.8,
      "label": {
        "use": "property",
        "which": "name"
      },
      "axis_y": {
        "use": "indicator",
        "which": "population_total",
        "scaleType": "linear"
      },
      "axis_x": {
        "use": "indicator",
        "which": "income_per_person_gdppercapita_ppp_inflation_adjusted",
        "scaleType": "log",
        "domainMin": 0.11,
        "domainMax": 500,
        "tailFatX": 1.85,
        "tailCutX": 0.2,
        "tailFade": 0.7,
        "xScaleFactor": 1.039781626,
        "xScaleShift": -1.127066411
      },
      "axis_s": {
        "use": "indicator",
        "which": "gapminder_gini",
        "scaleType": "linear"
      },
      "color": {
        "use": "property",
        "which": "world_4region",
        "scaleType": "ordinal",
        "syncModels": ["marker_colorlegend", "stack", "group"]
      },
      "stack": {
        "use": "constant",
        "which": "all"
      },
      "group": {
        "use": "property",
        "which": "world_4region",
        "merge": false
      }
    },
    "marker_colorlegend": {
      "space": ["entities_colorlegend"],
      "opacityRegular": 0.8,
      "opacityHighlightDim": 0.3, 
      "label": {
        "use": "property",
        "which": "name"
      },
      "hook_rank": {
        "use": "property",
        "which": "rank"
      },
      "hook_geoshape": {
        "use": "property",
        "which": "shape_lores_svg"
      }
    }
  },
  "ui": {
    "treemenu": {
      "folderStrategyByDataset": {
        "data": "spread",
        "data_wdi": "folder:other_datasets"
      }
    },
    "datawarning": {
      "doubtDomain": [1800, 1950, 2015],
      "doubtRange": [1.0, 0.8, 0.6]
    },
    "splash": true
  }
}
;