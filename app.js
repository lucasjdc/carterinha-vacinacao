import express from "express";

cons app = express();
app.use(express.json());

const vacinas = [
	{
		id: 1,
		nome: "Coronavac"
	},
	{
		id: 2,
		nome: "Febre Amarela"
	},
	{
		id: 3,
		nome: "MenACWY"		
	}
];

function buscaVacina(id) {
	return vacinas.findIndex(vacina => {
		return vacina.id === Number(id);
	})
}

app.get("/", (req, res) => {
	res.status(200).send("Carteira de vacinação");
});

app.get("/vacinas", (req, res) => {
	res.status(200).json(vacinas);
});

app.get("/vacinas/:id", (req, res) => {
	const index = buscaVacina(req.params.id);
	res.status(200).json(vacinas[index]);
});

app.post("/vacinas", (req, res) => {
	vacina.push(req.body);
	res.status(201).send("vacina cadastrada com sucesso");
});

app.put("/vacinas/:id", (req, res) => {
	const index = buscaVacina(req.params.id);
	vacinas[index].titulo = req.body.nome;
	res.status(200).json(vacinas);
});

export defaul app;