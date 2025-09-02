function parseini(text){
    let items = [];
    let sections = [];
    let lines = text.split("\n");
    let cursect = "";
    let curid = -1;

    let linescount = lines.length;
    let comments = [];

    for(let line of lines){
        // let data:string = line.trim();
        let data = line.trim();
        curid += 1;


        // ignore comments and skips
        if(!data){
            continue;
        }

        if(data.startsWith(";") || data.startsWith("#")){
            comments.push((`${line} `).slice(1,-1));
            continue;
        }

        // get the section breakers
        if(data.startsWith("[") && data.endsWith("]")){
            cursect = data.slice(1,-1);
            sections.push(cursect);
            continue;
        } else if(data.startsWith("[")){
            alert_warning(`invalid section declaration at line ${curid + 1}`)
            continue;
        }

        // key = val
        let pair = data.split("=");
        
        if(pair.length == 2){
            let theval = pair[1].trim().includes("\"") ? pair[1].trim().slice(1,-1) : pair[1].trim();

            items.push({
                section: cursect,
                key: pair[0],
                value: theval,
                lineid: (curid)
            })
        }
    }

    return {items,sections,lines,comments};
}