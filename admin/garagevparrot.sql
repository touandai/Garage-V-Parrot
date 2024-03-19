-- Table: public.users

-- DROP TABLE IF EXISTS public.users;

CREATE TABLE IF NOT EXISTS public.users
(
    id bigint NOT NULL DEFAULT nextval('users_id_seq'::regclass),
    nom character varying COLLATE pg_catalog."default" NOT NULL,
    email character varying COLLATE pg_catalog."default" NOT NULL,
    password character varying COLLATE pg_catalog."default" NOT NULL,
    roles_id integer,
    date_creation timestamp with time zone,
    CONSTRAINT users_pkey PRIMARY KEY (id),
    CONSTRAINT email UNIQUE (email),
    CONSTRAINT role_utilisateur FOREIGN KEY (roles_id)
        REFERENCES public.roles (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.users
    OWNER to postgres;
	
-- Table: public.annonces

-- DROP TABLE IF EXISTS public.annonces;

CREATE TABLE IF NOT EXISTS public.annonces
(
    id bigint NOT NULL DEFAULT nextval('annonces_id_seq'::regclass),
    marque character varying COLLATE pg_catalog."default" NOT NULL,
    modele character varying COLLATE pg_catalog."default" NOT NULL,
    annee integer NOT NULL,
    kilometre numeric NOT NULL,
    prix integer NOT NULL,
    energie character varying COLLATE pg_catalog."default" NOT NULL,
    description character varying COLLATE pg_catalog."default" NOT NULL,
    date_publication date NOT NULL,
    date_circulations date,
    CONSTRAINT annonces_pkey PRIMARY KEY (id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.annonces
    OWNER to postgres;	

-- Table: public.temoignages

-- DROP TABLE IF EXISTS public.temoignages;

CREATE TABLE IF NOT EXISTS public.temoignages
(
    id bigint NOT NULL DEFAULT nextval('temoignages_id_seq'::regclass),
    nom character varying COLLATE pg_catalog."default" NOT NULL,
    commentaires text COLLATE pg_catalog."default",
    note integer NOT NULL,
    date_avis timestamp with time zone NOT NULL,
    statut character varying COLLATE pg_catalog."default" NOT NULL,
    date_validation timestamp with time zone,
    CONSTRAINT temoignages_pkey PRIMARY KEY (id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.temoignages
    OWNER to postgres;
	
	-- Table: public.roles

-- DROP TABLE IF EXISTS public.roles;

CREATE TABLE IF NOT EXISTS public.roles
(
    id bigint NOT NULL DEFAULT nextval('roles_id_seq'::regclass),
    name character varying COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT roles_pkey PRIMARY KEY (id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.roles
    OWNER to postgres;
	
	
	-- Table: public.rendez_vous

-- DROP TABLE IF EXISTS public.rendez_vous;

CREATE TABLE IF NOT EXISTS public.rendez_vous
(
    id bigint NOT NULL DEFAULT nextval('rendez_vous_id_seq'::regclass),
    civilite character varying COLLATE pg_catalog."default" NOT NULL,
    immatriculation character varying COLLATE pg_catalog."default",
    nom character varying COLLATE pg_catalog."default" NOT NULL,
    prenom character varying COLLATE pg_catalog."default",
    email character varying COLLATE pg_catalog."default" NOT NULL,
    telephone character varying COLLATE pg_catalog."default",
    prestation character varying COLLATE pg_catalog."default" NOT NULL,
    creneaux text COLLATE pg_catalog."default",
    message text COLLATE pg_catalog."default" NOT NULL,
    date_validation timestamp with time zone,
    CONSTRAINT rendez_vous_pkey PRIMARY KEY (id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.rendez_vous
    OWNER to postgres;
	
	-- Table: public.horairesgarages

-- DROP TABLE IF EXISTS public.horairesgarages;

CREATE TABLE IF NOT EXISTS public.horairesgarages
(
    id bigint NOT NULL DEFAULT nextval('hotairesgarages_id_seq'::regclass),
    jour character varying COLLATE pg_catalog."default" NOT NULL,
    heure_debut_am character varying COLLATE pg_catalog."default" NOT NULL,
    heure_de_fin_am character varying COLLATE pg_catalog."default" NOT NULL,
    heure_debut_pm character varying COLLATE pg_catalog."default" NOT NULL,
    heure_de_fin_pm character varying COLLATE pg_catalog."default" NOT NULL,
    statut_am integer,
    statut_pm integer,
    CONSTRAINT hotairesgarages_pkey PRIMARY KEY (id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.horairesgarages
    OWNER to postgres;
	
	-- Table: public.contact

-- DROP TABLE IF EXISTS public.contact;

CREATE TABLE IF NOT EXISTS public.contact
(
    id bigint NOT NULL DEFAULT nextval('contact_id_seq'::regclass),
    nom character varying COLLATE pg_catalog."default" NOT NULL,
    prenom character varying COLLATE pg_catalog."default" NOT NULL,
    email character varying COLLATE pg_catalog."default" NOT NULL,
    telephone character varying COLLATE pg_catalog."default",
    message text COLLATE pg_catalog."default" NOT NULL,
    date_contact timestamp with time zone NOT NULL,
    CONSTRAINT contact_pkey PRIMARY KEY (id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.contact
    OWNER to postgres;
	
	
	
	-----------INSERTION DONNEES-------------------
	
	INSERT INTO public.users(
	id, nom, email, password, roles_id, date_creation)
	VALUES (1,'Parrot','touandaibrice@yahoo.fr','Vincent10',1,'2023-08-02'),
	(2,'Touandai','romaric.nganas@yahoo.fr','Romaric10',2'2023-08-02');
	
	INSERT INTO public.roles(
	id, name)
	VALUES (1,'Administrateur'),(2,'Employe');